@extends('layouts.app')

@section('template_title')
    {{ $studyType->name ?? 'Show Study Type' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Study Type</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('study-types.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Type Name:</strong>
                            {{ $studyType->type_name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
