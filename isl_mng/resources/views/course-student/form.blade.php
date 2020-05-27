<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('students_id') }}
            {{ Form::text('students_id', $courseStudent->students_id, ['class' => 'form-control' . ($errors->has('students_id') ? ' is-invalid' : ''), 'placeholder' => 'Students Id']) }}
            {!! $errors->first('students_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tuition_fees_id') }}
            {{ Form::text('tuition_fees_id', $courseStudent->tuition_fees_id, ['class' => 'form-control' . ($errors->has('tuition_fees_id') ? ' is-invalid' : ''), 'placeholder' => 'Tuition Fees Id']) }}
            {!! $errors->first('tuition_fees_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>