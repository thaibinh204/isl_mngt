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


class CalendarController extends Controller
{
    public function index()
    {

        $teachers = Teacher::select(DB::raw("id, CONCAT(last_name, ' ', first_name) AS full_name"))->get()->pluck('full_name', 'id');
        $course = Course::select('id', 'name')->get()->pluck('name', 'id');

        if(Auth::id()){
            $data = Schedule::where('teacher_id' , Auth::id())->get();
            $selectedTeacher =  Auth::id();
        }else{
            $data = Schedule::get();
            $selectedTeacher = -1;
        }

        $teachers[-1] = "Select All";    
        $course[-1] = "Select All";

        $selectedCourse = -1;

        return view('calendar', compact('data', 'teachers', 'course', 'selectedTeacher', 'selectedCourse'));
    }
    public function filterTask(Request $request)
    {
        $selectedTeacher = $request->teacher_id;
        $selectedCourse = $request->course_id;
        $data = null;

        if ($selectedTeacher == '-1' && $selectedCourse == '-1') {
            $data = Schedule::get();
        } else if ($selectedTeacher != '-1' && $selectedCourse != '-1') {
            $data = Schedule::where('teacher_id', $selectedTeacher)->where('course_id', $selectedCourse)->get();
        } else if ($selectedTeacher == '-1' && $selectedCourse != '-1') {
            $data = Schedule::where('course_id', $selectedCourse)->get();
        } else if ($selectedTeacher != '-1' && $selectedCourse == '-1') {
            $data = Schedule::where('teacher_id', $selectedTeacher)->get();
        }

        //dd($data);
        $teachers = Teacher::select(DB::raw("id, CONCAT(last_name, ' ', first_name) AS full_name"))->get()->pluck('full_name', 'id');
        $course = Course::select('id', 'name')->get()->pluck('name', 'id');
        $teachers[-1] = "Select All";
        $course[-1] = "Select All";

        return view('calendar', compact('data', 'teachers', 'course',  'selectedTeacher', 'selectedCourse'));
    }
}
