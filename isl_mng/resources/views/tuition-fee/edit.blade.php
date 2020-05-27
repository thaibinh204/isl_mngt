@extends('layouts.app')

@section('template_title')
    Update Tuition Fee
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Tuition Fee</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tuition-fees.update', $tuitionFee->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('tuition-fee.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
