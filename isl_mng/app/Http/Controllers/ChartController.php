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
        $color = ['(60, 141, 188, 0.9)', '(189, 0, 0, 0.9)', '(82, 189, 0, 0.9)', '(0, 189, 97, 0.9)', '(0, 179, 189, 0.9)', '(0, 116, 189, 0.9)', '(0, 47, 189, 0.9)', '(142, 0, 189, 0.9)', '(189, 0, 101, 0.9)'];
        $monthList = Schedule::select(DB::raw("distinct MONTH(start_time) as month"))->orderByRaw('month')->get();
        $teacher = DB::table('schedules')
            ->join('teachers', 'schedules.teacher_id', '=', 'teachers.id')
            ->select('schedules.teacher_id AS teacher_id', 'teachers.last_name', 'teachers.first_name')
            ->groupBy('teacher_id')
            ->get();
        $listItems = [];


        $labels = [];
        for ($i = 0; $i < count($monthList); $i++) {
            array_push($labels, $this->convertToMonth($monthList[$i]->month));
        }

        $dataList = [];
        for ($i = 0; $i < count($teacher); $i++) {
            $schedule = Schedule::select(DB::raw("sum(duration) AS time, MONTH(start_time) AS month"))->groupBy('teacher_id', 'month')->havingRaw('teacher_id=' . $teacher[$i]->teacher_id)->orderByRaw('month')->get();
            //\Debugbar::info($schedule);
            $data = [];
            for ($m = 0; $m < count($monthList); $m++) {
                //for ($n = 0; $n < count($schedule); $n++) {
                for ($n = 0; $n < count($monthList); $n++) {


                    if ($n < count($schedule) && $monthList[$m]->month ==  $schedule[$n]->month) {

                        $data[$m] = $schedule[$n]->time;
                        break;
                    }
                    if ($n >= count($schedule)) {
                        $data[$m] = 0;
                        break;
                    }
                }
            }

            array_push($dataList, $data);
        }
        \Debugbar::info($dataList);

        for ($i = 0; $i < count($dataList); $i++) {
            $item = (object)[
                'label'                => '',
                'backgroundColor'      => 'rgba(60,141,188,0.9)',
                'borderColor'          => 'rgba(60,141,188,0.8)',
                'pointRadius'          => 'false',
                'pointColor'           => '#3b8bba',
                'minBarLength'         =>  '0',
                'barPercentage'        =>  '2',
                'barThickness'         =>  '50',
                'maxBarThickness'      =>  '150',
                'pointStrokeColor'     => 'rgba(60,141,188,1)',
                'pointHighlightFill'   => '#fff',
                'pointHighlightStroke' => 'rgba(60,141,188,1)',
                'data'                 => []
            ];

            $item->backgroundColor = 'rgba' . $color[$i];
            $item->label = $teacher[$i]->first_name . ' ' . $teacher[$i]->last_name;
            $item->data = $dataList[$i];
            array_push($listItems, $item);
        }


        $areaChartData = (object)[
            'labels'    => $labels, 'datasets' => $listItems
        ];
        $jareaChartData = json_encode($areaChartData);
        //\Debugbar::info($areaChartData);
        //dd($jareaChartData);

        //$newData = json_encode($areaChartData,TRUE);
        //dd($jareaChartData[0]);
        return view('chart', compact('jareaChartData', 'teacher'));
    }

    function convertToMonth($month)
    {
        return date("F", mktime(0, 0, 0, $month, 10));
    }
}
