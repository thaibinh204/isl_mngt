@extends('layouts.app')

@section('template_title')
    Tuition Fee
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tuition Fee') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tuition-fees.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Course</th>
										<th>Study Type</th>
										<th>Fee</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tuitionFees as $tuitionFee)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $tuitionFee->course->name }}</td>
											<td>{{ $tuitionFee->studyType->type_name }}</td>
											<td>{{ $tuitionFee->fee }}</td>

                                            <td>
                                                <form action="{{ route('tuition-fees.destroy',$tuitionFee->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tuition-fees.show',$tuitionFee->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tuition-fees.edit',$tuitionFee->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $tuitionFees->links() !!}
            </div>
        </div>
    </div>
@endsection
