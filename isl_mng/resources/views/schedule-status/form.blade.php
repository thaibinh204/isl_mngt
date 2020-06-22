<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('schedule_id') }}
            {{ Form::text('schedule_id', $scheduleStatus->schedule_id, ['class' => 'form-control' . ($errors->has('schedule_id') ? ' is-invalid' : ''), 'placeholder' => 'Schedule Id']) }}
            {!! $errors->first('schedule_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $scheduleStatus->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('remark') }}
            {{ Form::text('remark', $scheduleStatus->remark, ['class' => 'form-control' . ($errors->has('remark') ? ' is-invalid' : ''), 'placeholder' => 'Remark']) }}
            {!! $errors->first('remark', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>