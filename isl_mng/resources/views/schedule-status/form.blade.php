<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Course') }}
            {{ Form::text('schedule_id', $selectedSchedule->id, ['class' => 'form-control' . ($errors->has('schedule_id') ? ' is-invalid' : ''), 'placeholder' => 'Schedule Id',  'hidden' => 'true']) }}
            {{ Form::text('', $selectedSchedule->course->name, ['class' => 'form-control' . ($errors->has('schedule_id') ? ' is-invalid' : ''), 'placeholder' => 'Schedule Id',  'readonly' => 'true']) }}
            {!! $errors->first('schedule_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label>Teacher</label>
            <input type="text" id='teacher' class="form-control" value="{{$selectedSchedule->teacher->last_name.' '.$selectedSchedule->teacher->last_name}}" readonly>
            {!! Form::select('teacher_id', $teachers ?? '', $selectedSchedule->teacher->teacher_id, ['class' => 'form-control', 'id'=>'teacher_select', 'style'=>'display:none']) !!}        
        </div>
        <div class="form-group">
            <label>Start Time</label>
            <input type="datetime-local" id="start_time" name='start_time'class="form-control" value="{{date('Y-m-d\TH:i', strtotime($selectedSchedule->start_time))}}" style="display:none">
            <input type="text" id='start_time_text' class="form-control" value="{{$selectedSchedule->start_time}}" readonly>
        </div>
        <div class="form-group">
            <label>End Time</label>
            <input type="datetime-local" id="end_time" name='end_time' class="form-control" value="{{date('Y-m-d\TH:i', strtotime($selectedSchedule->end_time))}}" style="display:none">
            <input type="text" id='end_time_text' class="form-control" value="{{$selectedSchedule->end_time}}" readonly>
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {!! Form::select('status', $status ?? '', null, ['class' => 'form-control']) !!}
            <!-- {{ Form::text('status', $scheduleStatus->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }} -->
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

<script>
$(document).ready(function() {
    $('#status').on('change', function() {
        if($(this).find(":selected").val() == 2){
            editTime();

        }else if ($(this).find(":selected").val() == 3){
            unEditTime();
            editTeacher();   
        }else{
            unEditTime();
            unEditTeacher();   
        }

       

    });

    function editTime(){
        $('#start_time').css('display', "");
        $('#end_time').css('display', "");
        $('#start_time_text').css('display', "none");
        $('#end_time_text').css('display', "none");
    };
    function unEditTime(){
        $('#start_time').css('display', "none");
        $('#end_time').css('display', "none");
        $('#start_time_text').css('display', "");
        $('#end_time_text').css('display', "");
    }
    function editTeacher(){
        $('#teacher').css('display', "none");
        $('#teacher_select').css('display', "");
    }

    function unEditTeacher(){
        $('#teacher').css('display', "");
        $('#teacher_select').css('display', "none");
    }
});
</script>