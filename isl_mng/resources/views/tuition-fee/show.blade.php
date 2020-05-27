@extends('layouts.app')

@section('template_title')
    {{ $tuitionFee->name ?? 'Show Tuition Fee' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Tuition Fee</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tuition-fees.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Course Id:</strong>
                            {{ $tuitionFee->course_id }}
                        </div>
                        <div class="form-group">
                            <strong>Study Type Id:</strong>
                            {{ $tuitionFee->study_type_id }}
                        </div>
                        <div class="form-group">
                            <strong>Fee:</strong>
                            {{ $tuitionFee->fee }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
