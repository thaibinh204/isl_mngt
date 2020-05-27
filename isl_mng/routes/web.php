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
Route::resource('course_students', 'CourseStudentController');
Route::resource('student', 'StudentController');
Route::resource('study_types', 'StudyTypeController');
Route::resource('tuition_fees', 'TuitionFeeController');

Route::get('/', function () {
    return view('welcome');
});
