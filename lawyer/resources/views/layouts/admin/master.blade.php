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
    <link rel="stylesheet" href="{{asset('assets/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>
{{--    <link rel="stylesheet"--}}
{{--          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css"/>--}}

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })


        var booking = @json($events ?? '')

        $('#calendar').fullCalendar({
            header: {
                left: 'prev, next, today',
                center: 'title',
                right: 'month , agendaWeek , agendaDay ,list',
            },
            events: booking,
            selectable: true,
            selectHelper: true,

            select: function (start, end, allDays) {
                allDays :true;
                alert('Clicked on: ' + date.getDate()+"/"+date.getMonth()+"/"+date.getFullYear());
                $('.modal').modal('toggle');

                $('#saveBtn').click(function () {
                    $('.modal').modal('hide');
                    var title = $('#title').val();
                    var start = moment(start).format('YYYY-MM-DD HH:mm:ss');
                    var end = moment(end).format('YYYY-MM-DD HH:mm:ss');
                    console.log(title);
                    console.log(start);
                    console.log(end);
                    $.ajax({
                        url: 'appointments/create',
                        type: 'POST',
                        dataType: 'json',
                        data: {title,start,end},
                        success: function (response) {
                            $('#calendar').fullCalendar('renderEvent', {
                                'title': response.title,
                                'start': response.start,
                                'end': response.end
                            });
                        },
                        error: function (error) {
                            console.log(error)
                        }
                    })
                })
            },
            editable: true,
            eventDrop: function (event) {
                var id = event.id;
                var start = moment(event.start).format('YYYY-MM-DD');
                var end = moment(event.end).format('YYYY-MM-DD');

                $.ajax({
                    type : "POST",
                    dataType :"json",
                    data : {start,end},
                    url :'appointments/update/'+id,
                    success : function (response){
                        console.log(response);
                    }
                })
            },
            eventClick :function (event){
                var id = event.id;

                $.ajax({
                    type: 'DELETE',
                    dataType : 'json',
                    url : 'appointments/delete/'+id,
                    success : function (response){

                        $('#calendar').fullCalendar('removeEvents', response.id)
                    }
                })
            }
        })
    });
</script>


</body>
</html>

