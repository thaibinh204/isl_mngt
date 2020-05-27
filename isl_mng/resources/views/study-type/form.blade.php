<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('type_name') }}
            {{ Form::text('type_name', $studyType->type_name, ['class' => 'form-control' . ($errors->has('type_name') ? ' is-invalid' : ''), 'placeholder' => 'Type Name']) }}
            {!! $errors->first('type_name', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>