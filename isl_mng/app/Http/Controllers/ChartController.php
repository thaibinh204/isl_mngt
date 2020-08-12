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
use Arrays;


class ChartController extends Controller
{
    public function teacherVsTimeChart()
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
        return view('chart-time', compact('jareaChartData', 'teacher'));
    }

    function convertToMonth($month)
    {
        return date("F", mktime(0, 0, 0, $month, 10));
    }

    function payChart()
    {
        $courseToTalList = $this->getCourseAndTotalSalary();
        //dd($courseToTalList);

        $labels = [];
        $teacherPayData = [];
        $studentPaiedData = [];

        for ($i = 0; $i < count($courseToTalList); $i++) {
            array_push($labels, $courseToTalList[$i]->name);
            $studentPaiedList = $this->getPaiedFeeByCourse($courseToTalList[$i]->course_id);
            //dd($studentPaiedList);
            $courseToTalList[$i]->student_paied = $studentPaiedList[0]->charged_fee;
            array_push($teacherPayData, $courseToTalList[$i]->teacher_pay);
            array_push($studentPaiedData, $courseToTalList[$i]->student_paied);

        }
        //dd($courseToTalList);

        $teacherPay = (object)[
            'label'                => 'Pay for teacher',
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
            'pointHighlightStroke' => 'rgba(60, 141, 188, 0.9)',
            'data'                 => $teacherPayData
        ];

        $studentPaied = (object)[
            'label'                => 'Student Paied',
            'backgroundColor'      => 'rgba(189, 0, 0, 0.9)',
            'borderColor'          => 'rgba(60,141,188,0.8)',
            'pointRadius'          => 'false',
            'pointColor'           => '#3b8bba',
            'minBarLength'         =>  '0',
            'barPercentage'        =>  '2',
            'barThickness'         =>  '50',
            'maxBarThickness'      =>  '150',
            'pointStrokeColor'     => 'rgba(60,141,188,1)',
            'pointHighlightFill'   => '#fff',
            'pointHighlightStroke' => 'rgba(189, 0, 0, 0.9)',
            'data'                 => $studentPaiedData
        ];
        
        $listItems = [];
        array_push($listItems, $teacherPay, $studentPaied);

        //dd($listItems);

        $areaChartData = (object)[
            'labels'    => $labels, 'datasets' => $listItems
        ];
        $jareaChartData = json_encode($areaChartData);
        //\Debugbar::info($areaChartData);
        //dd($jareaChartData);

        //$newData = json_encode($areaChartData,TRUE);
        //dd($jareaChartData[0]);
        return view('chart-pay', compact('jareaChartData'));


    }

    function getPaiedFeeByCourse($courseId)
    {
        $list = DB::table('courses')
            ->join('tuition_fees', 'courses.id', '=', 'tuition_fees.course_id')
            ->join('fee_status',  'tuition_fees.id', '=', 'fee_status.tuition_fee_id')
            ->select('courses.id', DB::raw('SUM(fee_status.charged_fee) AS charged_fee'))
            ->groupBy('courses.id')
            ->where('courses.id', $courseId)
            ->get();

        return ($list);
    }


    function chkCourseExistInArray($courseId, $list)
    {
        foreach ($list as $item) {
            if ($item->course_id == $courseId) {
                return true;
            }
        }
        return false;
    }

    function getCourseAndTotalSalary()
    {
        $list = DB::table('schedules')
            ->join('teachers', 'schedules.teacher_id', '=', 'teachers.id')
            ->join('courses',  'schedules.teacher_id', '=', 'courses.id')
            ->select('schedules.course_id', 'courses.name', 'schedules.teacher_id', 'teachers.hour_salary', DB::raw('SUM(schedules.duration) * teachers.hour_salary AS salary'))
            ->groupBy('schedules.course_id', 'schedules.teacher_id')
            ->get();

        $courseSalary = array();
        for ($i = 0; $i < count($list); $i++) {
            $key = $list[$i]->course_id;
            //dd($list[$i]);
            if (!$this->chkCourseExistInArray($key, $courseSalary)) {
                array_push($courseSalary, (object)[
                    'course_id' => $list[$i]->course_id,
                    'name' => $list[$i]->name,
                    'teacher_pay' => $list[$i]->salary,
                    'student_paied' => 0
                ]);
            } else {
                foreach ($courseSalary as $item) {
                    if ($item->course_id == $list[$i]->course_id) {
                        $item->teacher_pay = $item->teacher_pay + $list[$i]->salary;
                    }
                }
            }
        }

        return $courseSalary;
    }
}
