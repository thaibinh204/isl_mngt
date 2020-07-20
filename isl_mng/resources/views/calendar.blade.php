@extends('layouts.app')

@section('template_title')
Calendar
@endsection

@section('content')

<section class="content">   
    <div class="container-fluid">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <form method="POST" id='filter' action="{{ route('filter-task')}}" role="form" enctype="multipart/form-data">
            @csrf
            <div>
                <label>Teacher</label>
                {!! Form::select('teacher_id', $teachers ?? '', $selectedTeacher, ['class' => 'form-control', 'id'=>'teacher_select']) !!}
            </div>

            <div>
                <label>Course</label>
                {!! Form::select('course_id', $course ?? '', $selectedCourse, ['class' => 'form-control', 'id'=>'course_select']) !!}
            </div>
        </form>
        <div class="row">
            <div class="card card-primary">
                <div class="card-body p-0">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="../plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="../plugins/fullcalendar-timegrid/main.min.js"></script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                })

            })
        }



        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendarInteraction.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        // initialize the external events
        // -----------------------------------------------------------------
        var eventsList = [];
        var event = new Object();

        @foreach($data as $event)
        console.log('{{$event->course}}');
        eventsList.push({
            'title': '{{$event->course->name}}/{{$event->teacher->first_name}} {{$event->teacher->last_name}}',
            'start': new Date('{{$event->start_time}}'),
            'end': new Date('{{$event->end_time}}'),
            'allDay': false,
            'backgroundColor': '#f39c12',
            'id': '{{$event->course->id}}',
            "url": "{{ route('createOrUpdate', $event->id) }}",
        });
        @endforeach

        var calendar = new Calendar(calendarEl, {
            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },
            //Random default events
            events: eventsList,
            editable: true,
            droppable: false,
            eventClick: function(info) {
                console.log(info.event);
            },
            slotLabelFormat: [{
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            }],

        });

        calendar.render();

        $(".fc-day.fc-widget-content").click(function() {
            var url = "{{route('schedules.create')}}";
            document.location.href = url;
        });
    })

    $(document).ready(function() {
        $('#teacher_select, #course_select').on('change', function() {
            var course = $('#course_select').children("option:selected").val();
            var teacher = $('#teacher_select').children("option:selected").val();

            $( "#filter" ).submit();

        });
    });
</script>
@endsection()