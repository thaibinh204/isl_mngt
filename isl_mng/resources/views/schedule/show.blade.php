@extends('layouts.app')

@section('template_title')
    {{ $schedule->name ?? 'Show Schedule' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Schedule</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('schedules.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Start Time:</strong>
                            {{ $schedule->start_time }}
                        </div>
                        <div class="form-group">
                            <strong>End Time:</strong>
                            {{ $schedule->end_time }}
                        </div>
                        <div class="form-group">
                            <strong>Duration:</strong>
                            {{ $schedule->duration }}
                        </div>
                        <div class="form-group">
                            <strong>Remark:</strong>
                            {{ $schedule->remark }}
                        </div>
                        <div class="form-group">
                            <strong>Course Id:</strong>
                            {{ $schedule->course_id }}
                        </div>
                        <div class="form-group">
                            <strong>Teacher Id:</strong>
                            {{ $schedule->teacher_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
