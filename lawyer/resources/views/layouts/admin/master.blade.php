<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Lawyer') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- fullCalendar -->
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar/main.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar-interaction/main.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar-daygrid/main.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar-timegrid/main.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar-bootstrap/main.min.css')}}">--}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />--}}
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('layouts.admin.header');
    @include('layouts.admin.aside');


    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__($page)}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{__($page)}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content">
            <div class="container-fluid">
                @yield('content')

            </div>
        </div>

    </div>


    @include('layouts.admin.footer');
</div>


<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('assets/dist/js/adminlte.min.js?v=3.2.0')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.min.js')}}"></script>


<!-- jQuery UI -->
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dist/js/demo.js')}}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/fullcalendar/main.min.js')}}"></script>
<script src="{{asset('assets/plugins/fullcalendar-daygrid/main.min.js')}}"></script>
<script src="{{asset('assets/plugins/fullcalendar-timegrid/main.min.js')}}"></script>
<script src="{{asset('assets/plugins/fullcalendar-interaction/main.min.js')}}"></script>
<script src="{{asset('assets/plugins/fullcalendar-bootstrap/main.min.js')}}"></script>


{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {


        var events = @json($events);
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month ,agendaWeek, agendaDay '
            },
            events: events,
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                $('#createAppointment').modal('toggle');

                $('#saveBtn').click(function () {
                    var title = $('#title').val();
                    var start = moment(start).format('YYYY-MM-DD HH:mm:ss');
                    var end = moment(end).format('YYYY-MM-DD HH:mm:ss');

                    $.ajax({
                        url: "{{route('appointments.create')}}",
                        dataType: 'json',
                        type: 'POST',
                        data: {title, start, end},
                        success: function (response) {
                            $('#createAppointment').modal('hide');
                            $('#calendar').fullCalendar('renderEvent', {
                                'title': response.title,
                                'start': response.start,
                                'end': response.end
                            });
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    })
                })
            },


        });
    });
</script>
</body>
</html>
{{--</script>--}}
{{--<script>--}}
{{--    $(function () {--}}

{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}
{{--        /* initialize the external events--}}
{{--         -----------------------------------------------------------------*/--}}
{{--        function ini_events(ele) {--}}
{{--            ele.each(function () {--}}

{{--                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)--}}
{{--                // it doesn't need to have a start or end--}}
{{--                var eventObject = {--}}
{{--                    title: $.trim($(this).text()) // use the element's text as the event title--}}
{{--                }--}}

{{--                // store the Event Object in the DOM element so we can get to it later--}}
{{--                $(this).data('eventObject', eventObject)--}}

{{--                // make the event draggable using jQuery UI--}}
{{--                $(this).draggable({--}}
{{--                    zIndex: 1070,--}}
{{--                    revert: true, // will cause the event to go back to its--}}
{{--                    revertDuration: 0  //  original position after the drag--}}
{{--                })--}}

{{--            })--}}
{{--        }--}}

{{--        ini_events($('#external-events div.external-event'))--}}

{{--        /* initialize the calendar--}}
{{--         -----------------------------------------------------------------*/--}}
{{--        //Date for the calendar events (dummy data)--}}
{{--        var date = new Date()--}}
{{--        var d = date.getDate(),--}}
{{--            m = date.getMonth(),--}}
{{--            y = date.getFullYear()--}}

{{--        var Calendar = FullCalendar.Calendar;--}}
{{--        var Draggable = FullCalendarInteraction.Draggable;--}}

{{--        var containerEl = document.getElementById('external-events');--}}
{{--        var checkbox = document.getElementById('drop-remove');--}}
{{--        var calendarEl = document.getElementById('calendar');--}}

{{--        // initialize the external events--}}
{{--        // -------------------------------------------------------------------}}

{{--        new Draggable(containerEl, {--}}
{{--            itemSelector: '.external-event',--}}
{{--            eventData: function (eventEl) {--}}
{{--                console.log(eventEl);--}}
{{--                return {--}}
{{--                    title: eventEl.innerText,--}}
{{--                    backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),--}}
{{--                    borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),--}}
{{--                    textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),--}}
{{--                };--}}
{{--            }--}}
{{--        });--}}

{{--        // $('#calendar').fullCalendar()--}}

{{--        /* ADDING EVENTS */--}}
{{--        var currColor = '#3c8dbc' //Red by default--}}
{{--        //Color chooser button--}}
{{--        var colorChooser = $('#color-chooser-btn')--}}
{{--        $('#color-chooser > li > a').click(function (e) {--}}
{{--            e.preventDefault()--}}
{{--            //Save color--}}
{{--            currColor = $(this).css('color')--}}
{{--            //Add color effect to button--}}
{{--            $('#add-new-event').css({--}}
{{--                'background-color': currColor,--}}
{{--                'border-color': currColor--}}
{{--            })--}}
{{--        })--}}
{{--        $('#add-new-event').click(function (e) {--}}
{{--            e.preventDefault()--}}
{{--            //Get value and make sure it is not null--}}
{{--            var val = $('#new-event').val()--}}
{{--            if (val.length == 0) {--}}
{{--                return--}}
{{--            }--}}

{{--            //Create events--}}
{{--            var event = $('<div />')--}}
{{--            event.css({--}}
{{--                'background-color': currColor,--}}
{{--                'border-color': currColor,--}}
{{--                'color': '#fff'--}}
{{--            }).addClass('external-event')--}}
{{--            event.html(val)--}}
{{--            $('#external-events').prepend(event)--}}

{{--            //Add draggable funtionality--}}
{{--            ini_events(event)--}}

{{--            //Remove event from text input--}}
{{--            $('#new-event').val('')--}}
{{--        })--}}
{{--    })--}}
{{--</script>--}}
{{-- editable: true,--}}
{{-- droppable: true, // this allows things to be dropped onto the calendar !!!--}}
{{-- drop: function (info) {--}}
{{--     // is the "remove after drop" checkbox checked?--}}
{{--     if (checkbox.checked) {--}}
{{--         // if so, remove the element from the "Draggable Events" list--}}
{{--         info.draggedEl.parentNode.removeChild(info.draggedEl);--}}
{{--     }--}}
{{-- }--}}
