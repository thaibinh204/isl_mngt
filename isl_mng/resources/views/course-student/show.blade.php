@extends('layouts.app')

@section('template_title')
    {{ $courseStudent->name ?? 'Show Course Student' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Course Student</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('course-students.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Students:</strong>
                            {{ $courseStudent->student->first_name." ".$courseStudent->student->last_name }}
                        </div>
                        <div class="form-group">
                            <strong>Tuition Fees:</strong>
                            {{ $courseStudent->tuitionFee->course->name."-".$courseStudent->tuitionFee->studyType->type_name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
