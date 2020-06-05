<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\StudyType;
use App\Models\TuitionFee;
use Illuminate\Http\Request;

/**
 * Class TuitionFeeController
 * @package App\Http\Controllers
 */
class TuitionFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tuitionFees = TuitionFee::paginate();

        return view('tuition-fee.index', compact('tuitionFees'))
            ->with('i', (request()->input('page', 1) - 1) * $tuitionFees->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tuitionFee = new TuitionFee();
        $course = Course::select('id', 'name')->get()->pluck('name', 'id');
        $studyType = StudyType::select('id', 'type_name')->get()->pluck('type_name', 'id');
        //dd($course);
        return view('tuition-fee.create', compact(['tuitionFee', 'course', 'studyType']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TuitionFee::$rules);

        $tuitionFee = TuitionFee::create($request->all());

        return redirect()->route('tuition-fees.index')
            ->with('success', 'TuitionFee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tuitionFee = TuitionFee::find($id);

        return view('tuition-fee.show', compact('tuitionFee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tuitionFee = TuitionFee::find($id);
        $course = Course::select('id', 'name')->get()->pluck('name', 'id');
        $studyType = StudyType::select('id', 'type_name')->get()->pluck('type_name', 'id');

        return view('tuition-fee.edit', compact(['tuitionFee', 'course', 'studyType']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuitionFee $tuitionFee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TuitionFee $tuitionFee)
    {
        request()->validate(TuitionFee::$rules);

        $tuitionFee->update($request->all());

        return redirect()->route('tuition-fees.index')
            ->with('success', 'TuitionFee updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tuitionFee = TuitionFee::find($id)->delete();

        return redirect()->route('tuition-fees.index')
            ->with('success', 'TuitionFee deleted successfully');
    }
}
