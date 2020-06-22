<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Http\Request;
use  Response;
use DB;
use Calendar;
use Auth;


class CalendarController extends Controller
{
    public function index()
    {
        // $data = Schedule::get(); 
        
        $data = Schedule::where('teacher_id' , Auth::id())->get();
        
        return view('calendar', compact('data',));
    }
}
