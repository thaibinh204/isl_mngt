<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Http\Request;
use  Response;
use DB;
use Calendar;


class CalendarController extends Controller
{
    public function index()
    {
        $data = Schedule::get();
        return view('calendar', compact('data'));
    }
}
