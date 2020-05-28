<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('courses', 'CourseController');
Route::resource('course-students', 'CourseStudentController');
Route::resource('students', 'StudentController');
Route::resource('study-types', 'StudyTypeController');
Route::resource('tuition-fees', 'TuitionFeeController');
Route::resource('schedules', 'ScheduleController');
Route::resource('skills', 'SkillController');

Route::get('/', function () {
    return view('welcome');
});
