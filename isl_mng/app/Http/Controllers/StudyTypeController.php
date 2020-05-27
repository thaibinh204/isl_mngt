<?php

namespace App\Http\Controllers;

use App\Models\StudyType;
use Illuminate\Http\Request;

/**
 * Class StudyTypeController
 * @package App\Http\Controllers
 */
class StudyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studyTypes = StudyType::paginate();

        return view('study-type.index', compact('studyTypes'))
            ->with('i', (request()->input('page', 1) - 1) * $studyTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studyType = new StudyType();
        return view('study-type.create', compact('studyType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(StudyType::$rules);

        $studyType = StudyType::create($request->all());

        return redirect()->route('study-types.index')
            ->with('success', 'StudyType created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studyType = StudyType::find($id);

        return view('study-type.show', compact('studyType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $studyType = StudyType::find($id);

        return view('study-type.edit', compact('studyType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  StudyType $studyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudyType $studyType)
    {
        request()->validate(StudyType::$rules);

        $studyType->update($request->all());

        return redirect()->route('study-types.index')
            ->with('success', 'StudyType updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $studyType = StudyType::find($id)->delete();

        return redirect()->route('study-types.index')
            ->with('success', 'StudyType deleted successfully');
    }
}
