@extends('layouts.app')

@section('template_title')
    {{ $skill->name ?? 'Show Skill' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Skill</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('skills.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $skill->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
