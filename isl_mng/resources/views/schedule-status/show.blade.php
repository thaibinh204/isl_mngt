@extends('layouts.app')

@section('template_title')
    {{ $scheduleStatus->name ?? 'Show Schedule Status' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Schedule Status</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('schedule-status.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Schedule Id:</strong>
                            {{ $scheduleStatus->schedule_id }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $scheduleStatus->status }}
                        </div>
                        <div class="form-group">
                            <strong>Remark:</strong>
                            {{ $scheduleStatus->remark }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
