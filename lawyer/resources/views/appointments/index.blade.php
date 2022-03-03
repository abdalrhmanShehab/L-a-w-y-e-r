@extends('layouts.admin.master')
@section('content')

    {{--    modal show appointment details --}}
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content row">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{--    end create appointment--}}

    {{--  modal create appointmetnt --}}
{{--    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">--}}
{{--        Launch demo modal--}}
{{--    </button>--}}
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content row">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body selectModal form-group">
                    <select name="title" id="title" class="form-control">
                        <option value="" selected disabled>Select ..</option>
                        <option value="available">avaliable</option>
                        <option value="Booking">Booking</option>
                    </select>
                    <div>
                        <label for="#start" class="form-label"> {{__('Start')}} </label>
                        <input type="datetime-local" class="form-control" id="start"/>
                    </div>
                    <div>
                        <label for="#end" class="form-label"> {{__('End')}} </label>
                        <input type="datetime-local" class="form-control" id="end"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-primary" id="saveBtn"
                            onclick="addAppointment()">{{__('Add')}}</button>
                    {{--                    <a href="{{route('appointment.create')}}" class="btn btn-outline-primary">{{__('Add')}}</a>--}}
                </div>
            </div>
        </div>
    </div>
    {{-- end modal create appointment--}}
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>


    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendar = $('#calendar').fullCalendar({

                header: {
                    left: 'prev , next today',
                    center: 'title',
                    right: 'month ,agendaWeek , agendaDay'
                },

                events: 'appointments',
                selectable: true,
                selectHelper: true,
                select: function (start, end, allday) {
                    $('#modalCreate').modal('toggle');
                //     // var title = prompt('select your event :');
                //     $('#modalCreate').modal('toggle');
                //     var title = $('#title').val();
                //     if (title) {
                //         var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                //         var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
                //         var data = '';
                //         data = data + "<input type='text' vlaue="+ start+"/>"
                //         data = data + "<input type='text' vlaue="+ end +"/>"
                //         $('.selectModal').html(data);
                //         // $.ajax({
                //         //     url: "appointment/action",
                //         //     type: "POST",
                //         //     data: {
                //         //         title: title,
                //         //         start: start,
                //         //         end: end,
                //         //         type: 'add'
                //         //     },
                //         //     success: function (data) {
                //         //         calendar.fullCalendar('refetchEvents');
                //         //         Swal.fire({
                //         //             position: 'top-end',
                //         //             icon: 'success',
                //         //             title: 'event created successfully',
                //         //             showConfirmButton: false,
                //         //             timer: 1500
                //         //         })
                //         //     },
                //         // })
                //     }
                    $("#calendar").refetchEvents();
                },
                editable: true,
                eventResize: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;

                    $.ajax({
                        url: "appointment/action",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type: 'update'
                        },
                        success: function (response) {
                            calendar.fullCalendar('refetchEvents');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'event updated successfully',
                                showConfirmButton: false,
                                timer: 1500
                            })

                        },
                    })
                },
                eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;

                    $.ajax({
                        url: "appointment/action",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type: 'update'
                        },
                        success: function (response) {
                            calendar.fullCalendar('refetchEvents');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'event updated successfully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                    })
                },
                eventClick: function (event) {
                    console.log(event)
                    calendar.fullCalendar('refetchEvents');
                    $('#modal').modal('toggle');
                    var id = event.id;
                    $.ajax({
                        url: "appointment/action",
                        type: "POST",
                        dataType: "json",
                        data: {
                            'type': 'details',
                            'id': id
                        },
                        success: function (response) {

                            var data = '';
                            data = data + "<ul class='list-group'>"

                            data = data + "<li class='list-group-item'><h5><label class='form-label mx-3 text-secondary'>{{__('Stauts')}} :</lable>"
                            data = data + "<label class='form-label mx-3' style='color:" + response.color + "'>" + response.status + "</label>"
                            data = data + "</h5></li>"

                            data = data + "<li class='list-group-item'><h5><label class='form-label mx-3 text-secondary'>{{__('Start')}} :</lable>"
                            data = data + "<label class='form-label mx-3 text-primary'>" + response.start + "</label>"
                            data = data + "</h5></li>"

                            data = data + "<li class='list-group-item'><h5><label class='form-label mx-3 text-secondary'>{{__('End')}} :</lable>"
                            data = data + "<label class='form-label mx-3 text-primary'>" + response.end + "</label>"
                            data = data + "</h5></li>"

                            data = data + "<li class='list-group-item'><h5><label class='form-label mx-3 text-secondary'>{{__('Lawyer')}} :</lable>"
                            data = data + "<label class='form-label mx-3 text-primary'>" + response.lawyer + "</label>"
                            data = data + "</h5></li>"

                            data = data + "<li class='list-group-item'><h5><label class='form-label mx-3 text-secondary'>{{__('User')}} :</lable>"
                            data = data + "<label class='form-label mx-3 text-primary'>" + response.user + "</label>"
                            data = data + "</h5></li>"

                            data = data + "<li class='list-group-item'><h5><label class='form-label mx-3 text-secondary'>{{__('Subject of Case')}} :</lable>"
                            data = data + "<label class='form-label mx-3 text-primary'>" + response.subject + "</label>"
                            data = data + "</h5></li>"

                            data = data + "<li class='list-group-item'><h5><label class='form-label mx-3 text-secondary'>{{__('Details about this Case')}} :</lable></h5>"
                            data = data + "<textarea disabled class='form-control mx-3 text-primary'>" + response.details + "</textarea>"
                            data = data + "</li>"

                            data = data + "</ul>"
                            $('.modal-body').html(data);
                            $("#calendar").refetchEvents();
                        },
                        error: function (error) {
                            console.log(error)
                        }
                    })

                }
            });
        });

        function addAppointment() {
            var title = $('#title').val();
            var start = $('#start').val();
            var end = $('#end').val();
            $.ajax({
                url: "appointment/action",
                type: "POST",
                dataType : "json",
                data: {
                    title: title,
                    start: start,
                    end: end,
                    type: 'add'
                },
                success : function (data){
                    $('#modalCreate').modal('hide');
                    $('#calendar').fullCalendar('refetchEvents');
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Appointments Added successfully'
                    })

                },
                error :function (error){
                    console.log(error);
                }
            });

            }
    </script>
@endsection
