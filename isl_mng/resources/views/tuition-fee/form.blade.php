<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Course') }}
            <!-- {{ Form::text('course_id', $tuitionFee->course_id, ['class' => 'form-control' . ($errors->has('course_id') ? ' is-invalid' : ''), 'placeholder' => 'Course Id']) }} -->
            {!! Form::select('course_id', $course ?? '', null, ['class' => 'form-control']) !!}
            {!! $errors->first('course_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Study Type') }}
            <!-- {{ Form::text('study_type_id', $tuitionFee->study_type_id, ['class' => 'form-control' . ($errors->has('study_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Study Type Id']) }} -->
            {!! Form::select('study_type_id', $studyType ?? '', null, ['class' => 'form-control']) !!}
            {!! $errors->first('study_type_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fee') }}
            {{ Form::text('fee', $tuitionFee->fee, ['class' => 'form-control' . ($errors->has('fee') ? ' is-invalid' : ''), 'placeholder' => 'Fee']) }}
            {!! $errors->first('fee', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>