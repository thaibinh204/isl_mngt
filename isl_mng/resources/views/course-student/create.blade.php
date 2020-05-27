@extends('layouts.app')

@section('template_title')
    Create Course Student
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Course Student</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('course-students.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('course-student.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
