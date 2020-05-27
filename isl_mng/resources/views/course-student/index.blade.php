@extends('layouts.app')

@section('template_title')
    Course Student
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Course Student') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('course-students.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Students Id</th>
										<th>Tuition Fees Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courseStudents as $courseStudent)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $courseStudent->students_id }}</td>
											<td>{{ $courseStudent->tuition_fees_id }}</td>

                                            <td>
                                                <form action="{{ route('course-students.destroy',$courseStudent->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('course-students.show',$courseStudent->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('course-students.edit',$courseStudent->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $courseStudents->links() !!}
            </div>
        </div>
    </div>
@endsection
