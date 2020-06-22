<?php

namespace App\Http\Controllers;

use App\Models\ScheduleStatus;
use Illuminate\Http\Request;

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

        return view('schedule-status.index', compact('scheduleStatuses'))
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
        $scheduleStatus = ScheduleStatus::find($id);
        if($scheduleStatus){
            return view('schedule-status.edit', compact('scheduleStatus'));

            
        }else{
            $scheduleStatus = new ScheduleStatus();
            return view('schedule-status.create', compact('scheduleStatus'));
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
        request()->validate(ScheduleStatus::$rules);

        $scheduleStatus = ScheduleStatus::create($request->all());

        return redirect()->route('schedule-status.index')
            ->with('success', 'ScheduleStatus created successfully.');
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
        request()->validate(ScheduleStatus::$rules);

        $scheduleStatus->update($request->all());

        return redirect()->route('schedule-status.index')
            ->with('success', 'ScheduleStatus updated successfully');
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
