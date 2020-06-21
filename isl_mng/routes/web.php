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
Route::resource('teachers','TeacherController');

Route::get('calendar','CalendarController@index');
Route::get('/', 'LoginController@index') -> name('index');
Route::get('/login', 'LoginController@login') -> name('login');
Route::post('/login/checkLogin', 'LoginController@checkLogin') -> name('checkLogin');
Route::get('/logout','LoginController@logout')->name('logout');





// Route::get('/', function () {
//     return view('welcome');
// });
