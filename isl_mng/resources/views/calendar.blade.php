
@extends('layouts.app')

@section('template_title')
Calendar
@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
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
<script>

    
    $(function() {

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
        eventsList.push({
            'title': '{{$event->course->name}}/{{$event->teacher->first_name}} {{$event->teacher->last_name}}',
            'start': '{{$event->start_time}}',
            'end':  new Date({{explode("-",$event->end_time)[0]}}, {{explode("-",$event->end_time)[1]-1}}, {{substr(explode("-",$event->end_time)[2],0,2)+1}}),
            'allDay': 'true',
            'backgroundColor': '#f39c12'
        });
        @endforeach

        var calendar = new Calendar(calendarEl, {
            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            //Random default events
            events: eventsList,
            editable: true,
            droppable: false,
        });

        calendar.render();

    $(".fc-day.fc-widget-content").click(function() {
        var url = "{{route('schedules.create')}}";
        document.location.href = url;
        });
    })

</script>
@endsection()
