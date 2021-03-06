<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('start_time') }}
            {{ Form::date('start_time',$schedule->start_time, ['class' => 'form-control' . ($errors->has('start_time') ? ' is-invalid' : ''), 'placeholder' => 'StartTime']) }}
            <!-- {{ Form::text('start_time', $schedule->start_time, ['class' => 'form-control' . ($errors->has('start_time') ? ' is-invalid' : ''), 'placeholder' => 'Start Time']) }} -->
            {!! $errors->first('start_time', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('end_time') }}
            {{ Form::date('end_time',$schedule->end_time, ['class' => 'form-control' . ($errors->has('end_time') ? ' is-invalid' : ''), 'placeholder' => 'EndTime']) }}
            <!-- {{ Form::text('end_time', $schedule->end_time, ['class' => 'form-control' . ($errors->has('end_time') ? ' is-invalid' : ''), 'placeholder' => 'End Time']) }} -->
            {!! $errors->first('end_time', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('duration') }}
            {{ Form::text('duration', $schedule->duration, ['class' => 'form-control' . ($errors->has('duration') ? ' is-invalid' : ''), 'placeholder' => 'Duration']) }}
            {!! $errors->first('duration', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('remark') }}
            {{ Form::text('remark', $schedule->remark, ['class' => 'form-control' . ($errors->has('remark') ? ' is-invalid' : ''), 'placeholder' => 'Remark']) }}
            {!! $errors->first('remark', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('') }}
            <!-- {{ Form::text('course_id', $schedule->course_id, ['class' => 'form-control' . ($errors->has('course_id') ? ' is-invalid' : ''), 'placeholder' => 'Course Id']) }} -->
            {!! Form::select('course_id', $course ?? '', null, ['class' => 'form-control']) !!}
            {!! $errors->first('course_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Teacher') }}
            {!! Form::select('teacher_id', $teachers ?? '', null, ['class' => 'form-control']) !!}
            {!! $errors->first('teacher_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>