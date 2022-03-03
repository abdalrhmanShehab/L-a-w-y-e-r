@extends('layouts.user.master')
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="Booking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Please insert some details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="subjectError" class="form-text text-danger text-center m-auto"></div>
                <div id="detailsError" class="form-text text-danger text-center m-auto"></div>
                <div class="modal-body modalA">
                </div>
            </div>
        </div>

    </div>

    <div class="row justify-content-center wrapper my-5">
        <div class="col-6 m-auto">
            <table class="table m-auto">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Lawyer</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody class="tlawyer">

                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-center wrapper my-5" id="appoint">
        <div class="col-10 m-auto">
            <table class="table m-auto">
                <thead>
                <tr>
                    {{--                    <th scope="col">#</th>--}}
                    <th scope="col">status</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody class="bodyAp">

                </tbody>
            </table>
        </div>

    </div>
    {{--    <script type="text/javascript">--}}
    {{--        $.ajaxSetup({--}}
    {{--            headers: {--}}
    {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--            }--}}
    {{--        });--}}
    {{--    </script>--}}

    <script>

        $('#appoint').hide();
        $('#booking').hide();


        //get all data from teacher table
        function allData() {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "lawyer/all",
                success: function (respone) {
                    var data = '';
                    $.each(respone, function (key, value) {
                        data = data + "<tr>"
                        data = data + "<td>" + value.id + "</td>"
                        data = data + "<td>" + value.name + "</td>"
                        // data = data + "<td>"+value.subject+"</td>"
                        data = data + "<td>"
                        data = data + "<button class='btn btn-sm btn-primary m-2' onclick='ShowAppointments(" + value.id + ")'>View Appointments</button>"
                        data = data + "</td>"
                        data = data + "</tr>"
                    })
                    $('.tlawyer').html(data);
                }
            })
        }

        allData();


        function clearData() {
            $('#subjectError').text('');
            $('#detailsError').text('');
        }


        //show appointments
        function ShowAppointments(id) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "appointments/" + id,
                success: function (response) {
                    var data = '';
                    $.each(response, function (key, value) {

                        $('#appoint').show();
                        data = data + "<tr>"
                        data = data + "<td style=color:" + value.color + " class = 'text-bold m-auto'>" + value.title + "</td>"
                        data = data + "</td>"
                        data = data + "<td>" + value.start + "</td>"
                        data = data + "<td>" + value.end + "</td>"
                        data = data + "<td>"
                        data = data + "<button class='btn btn-sm btn-primary m-2' onclick='getBooking(" + value.id + ")'>{{__('Booking')}}</button>"
                        {{--data = data + "<button class='btn btn-sm btn-primary m-2' onclick='viewAppointment(" + value.id + ")'>{{__('View')}}</button>"--}}
                        data = data + "</td>"
                        data = data + "</tr>"
                    })
                    $('.bodyAp').html(data);
                    allData();
                }
            })
        }

        //booking
        function getBooking(id) {
            $('#Booking').modal('toggle');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "getBooking/" + id,
                success: function (response) {
                    console.log(response)

                    var data = '';
                    // $.each(response, function (key, value) {
                    data = data + "<input type='hidden' value='"+ id +"' id='id' />"
                    data = data + "<div class='form-group'>"
                    data = data + "<div class ='form-control>"
                    data = data + "<label class ='form-lable'>{{__('Subject')}}</label>"
                    data = data + "<input type='text' id='subject' class='form-control' />"
                    data = data + "</div>"
                    data = data + "<div class ='form-control>"
                    data = data + "<label class ='form-lable'>{{__('Details')}}</label>"
                    data = data + "<textarea id='details' class='form-control'></textarea>"
                    data = data + "</div>"
                    data = data + "<div class='modal-footer'>"
                    data = data + "<button class='btn btn-lg p-1 btn-primary m-auto' onclick='Booking()'>{{__('Booking')}}</button>"
                    data = data + "</div>"
                    data = data + "</div>"
                    // })

                    $('.modalA').html(data);
                }
            })
        }

        function Booking() {
            var id = $('#id').val();
            var subject = $('#subject').val();
            var details = $('#details').val();
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {id, subject, details},
                url: "Booking",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function (data) {
                    console.log(data)
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
                        title: 'Appointments Booking successfully and save in your appointments'
                    })
                    $('#Booking').modal('hide');
                    ShowAppointments(data.lawyer_id);
                    clearData();
                },
                error: function (error) {
                    console.log(error)
                    $('#subjectError').text(error.responseJSON.errors.subject);
                    $('#detailsError').text(error.responseJSON.errors.details);
                }
            })
        }
    </script>
@endsection
