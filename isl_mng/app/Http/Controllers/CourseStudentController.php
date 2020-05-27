<?php

namespace App\Http\Controllers;

use App\Models\CourseStudent;
use Illuminate\Http\Request;

/**
 * Class CourseStudentController
 * @package App\Http\Controllers
 */
class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseStudents = CourseStudent::paginate();

        return view('course-student.index', compact('courseStudents'))
            ->with('i', (request()->input('page', 1) - 1) * $courseStudents->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courseStudent = new CourseStudent();
        return view('course-student.create', compact('courseStudent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(CourseStudent::$rules);

        $courseStudent = CourseStudent::create($request->all());

        return redirect()->route('course-students.index')
            ->with('success', 'CourseStudent created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courseStudent = CourseStudent::find($id);

        return view('course-student.show', compact('courseStudent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courseStudent = CourseStudent::find($id);

        return view('course-student.edit', compact('courseStudent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CourseStudent $courseStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseStudent $courseStudent)
    {
        request()->validate(CourseStudent::$rules);

        $courseStudent->update($request->all());

        return redirect()->route('course-students.index')
            ->with('success', 'CourseStudent updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $courseStudent = CourseStudent::find($id)->delete();

        return redirect()->route('course-students.index')
            ->with('success', 'CourseStudent deleted successfully');
    }
}
