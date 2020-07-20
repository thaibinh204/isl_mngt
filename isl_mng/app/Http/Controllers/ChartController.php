<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;
use  Response;
use DB;
use Calendar;
use Auth;


class ChartController extends Controller
{
    public function index()
    {
        //  $schedule = Schedule::select(DB::raw("sum(duration) AS time, teacher_id, MONTH(start_time)"))->groupBy('teacher_id', 'MONTH(start_time)')->get();
        $monthList = Schedule::select(DB::raw("distinct MONTH(start_time) as month"))->orderByRaw('month')->get();
        $teacher = Schedule::select(DB::raw("distinct teacher_id AS teacher_id"))->get();
        //dd(($teacher));
        $listItems = [];
        $item = [
            'label'                => 'Digital Goods',
            'backgroundColor'      => 'rgba(60,141,188,0.9)',
            'borderColor'          => 'rgba(60,141,188,0.8)',
            'pointRadius'          => 'false',
            'pointColor'           => '#3b8bba',
            'pointStrokeColor'     => 'rgba(60,141,188,1)',
            'pointHighlightFill'   => '#fff',
            'pointHighlightStroke' => 'rgba(60,141,188,1)',
            'data'                 => []
        ];

        $label = [];
        for ($i = 0; $i < count($monthList); $i++) {
            array_push($label, $this->convertToMonth($monthList[$i]->month));
        }

        $dataList = [];
        for ($i = 0; $i < count($teacher); $i++) {
            
            $schedule = Schedule::select(DB::raw("sum(duration) AS time, MONTH(start_time) AS month"))->groupBy('teacher_id', 'month')->havingRaw('teacher_id=' . $teacher[$i]->teacher_id)->get();
            $data = [];
            for ($m = 0; $m < count($monthList); $m++) {
                for ($n = 0; $n < count($schedule); $n++) {
                    
                    if ($monthList[$m]->month ==  $schedule[$n]->month) {
                        $data[$m] = $schedule[$n]->time;
                    }
                }
            }
            \Debugbar::info($data);
        }

        //dd($dataList);

        //dd($label);
        return view('chart');
    }

    function convertToMonth($month)
    {
        return date("F", mktime(0, 0, 0, $month, 10));
    }
}
