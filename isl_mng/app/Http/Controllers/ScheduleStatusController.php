<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use App\Models\ScheduleStatus;
use App\Models\Schedule;
use App\Models\Course;
use Illuminate\Http\Request;
use DB;

/**
 * Class ScheduleStatusController
 * @package App\Http\Controllers
 */
class ScheduleStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scheduleStatuses = ScheduleStatus::paginate();
        $status = [
            1 => "Continue",
            2 => "Change time",
            3 => "Change teacher",
            4 => "Cancel"
        ];

        return view('schedule-status.index', compact('scheduleStatuses', 'status'))
            ->with('i', (request()->input('page', 1) - 1) * $scheduleStatuses->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $scheduleStatus = new ScheduleStatus();
        return view('schedule-status.create', compact('scheduleStatus'));
    }

    public function createOrUpdate($id)
    {

        $status = [
            1 => "Continue",
            2 => "Change time",
            3 => "Change teacher",
            4 => "Cancel"
        ];

        $selectedSchedule = Schedule::find($id);

        $teachers = Teacher::select(DB::raw("id, CONCAT(last_name, ' ', first_name) AS full_name"))->get()->pluck('full_name', 'id');

        $scheduleStatus = ScheduleStatus::find($id);
        if($scheduleStatus){
            return view('schedule-status.edit', compact('scheduleStatus', 'status', 'teachers', 'selectedSchedule'));

            
        }else{
            $scheduleStatus = new ScheduleStatus();
            $scheduleStatus->schedule_id = $id;
            return view('schedule-status.create', compact('scheduleStatus', 'status', 'teachers', 'selectedSchedule'));
        }
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->status == '2'){// Change time
            $start_time = $request->start_time;
            $end_time = $request->end_time;
            $schedule = Schedule::find($request->schedule_id);
            $schedule->start_time = $start_time;
            $schedule->end_time = $end_time;
            $schedule->update();

        }else if($request->status == '3'){// Change teacher
            $teacherId = $request->teacher_id;
            $schedule = Schedule::find($request->schedule_id);
            $schedule->teacher_id = $teacherId;
            $schedule->update();
        }
        request()->validate(ScheduleStatus::$rules);

        $scheduleStatus = ScheduleStatus::create($request->all());

        return redirect()->route('calendar')
            ->with('success', 'Task update done');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scheduleStatus = ScheduleStatus::find($id);

        return view('schedule-status.show', compact('scheduleStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scheduleStatus = ScheduleStatus::find($id);

        return view('schedule-status.edit', compact('scheduleStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ScheduleStatus $scheduleStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleStatus $scheduleStatus)
    {
        if($request->status == '2'){// Change time
            $start_time = $request->start_time;
            $end_time = $request->end_time;
            $schedule = Schedule::find($scheduleStatus->schedule_id);
            $schedule->start_time = $start_time;
            $schedule->end_time = $end_time;
            $schedule->update();

        }else if($request->status == '3'){// Change teacher
            $teacherId = $request->teacher_id;
            $schedule = Schedule::find($scheduleStatus->schedule_id);
            $schedule->teacher_id = $teacherId;
            $schedule->update();
        }

        request()->validate(ScheduleStatus::$rules);

        $scheduleStatus->update($request->all());

        return redirect()->route('calendar')
            ->with('success', 'Task update done');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $scheduleStatus = ScheduleStatus::find($id)->delete();

        return redirect()->route('schedule-status.index')
            ->with('success', 'ScheduleStatus deleted successfully');
    }
}
