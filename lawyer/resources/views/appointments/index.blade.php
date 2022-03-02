@extends('layouts.admin.master')
@section('content')

    {{--    modal create appointment--}}

    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="SaveBtn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{--    end create appointment--}}
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
                    var title = prompt('insert your event');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                        var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                        $.ajax({
                            url: "appointment/action",
                            type: "POST",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                type: 'add'
                            },
                            success: function (data) {
                                calendar.fullCalendar('refetchEvents');
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'event created successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            },
                        })
                    }
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
                    console.log('clicked')
                    // $('#modal').modal('toggle');
                    // Swal.fire({
                    //     title: 'Are you sure?',
                    //     text: "You won't be able to revert this!",
                    //     icon: 'warning',
                    //     showCancelButton: true,
                    //     confirmButtonColor: '#3085d6',
                    //     cancelButtonColor: '#d33',
                    //     confirmButtonText: 'Yes, delete it!'
                    // }).then((result) => {
                    //     if (result.isConfirmed) {
                    //         var id = event.id;
                    //         $.ajax({
                    //             url: "appointment/action",
                    //             type: "POST",
                    //             data: {
                    //                 id: id,
                    //                 type: 'delete'
                    //             },
                    //             success: function (response) {
                    //                 calendar.fullCalendar('refetchEvents');
                    //                 Swal.fire({
                    //                     position: 'top-end',
                    //                     icon: 'success',
                    //                     title: 'event deleted successfully',
                    //                     showConfirmButton: false,
                    //                     timer: 1500
                    //                 })
                    //             },
                    //         })
                    //         Swal.fire(
                    //             'Deleted!',
                    //             'Your file has been deleted.',
                    //             'success'
                    //         )
                    //     }
                    // })


                }
            });

        });

    </script>
@endsection
