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
                <div id="subjectError" class="form-text text-danger text-center m-auto">subjectError</div>
                <div id="detailsError" class="form-text text-danger text-center m-auto">detailsError</div>
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


    <script>
        // $('#addT').show();
        // $('#add ').show();
        $('#appoint').hide();
        $('#booking').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

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
                        // data = data + "<button class='btn btn-sm btn-primary m-2' onclick='editData("+value.id+")'>Edit</button>"

                        data = data + "</td>"
                        data = data + "</tr>"
                    })
                    $('.tlawyer').html(data);
                }
            })
        }

        allData();

        //clear data after add in form
        function clearData() {
            $('#name').val('');
            $('#subject').val('');
            $('#nameError').text('');
            $('#subjectError').text('');
        }

        //add data to table teacher
        function addData() {
            var name = $('#name').val();
            var subject = $('#subject').val();
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {name: name, subject: subject},
                url: "/teacher/store",
                success: function (data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Teacher add successfully'
                    })
                    clearData();
                    allData();
                },
                error: function (error) {
                    $('#nameError').text(error.responseJSON.errors.name);
                    $('#subjectError').text(error.responseJSON.errors.subject);
                }
            })
        }

        //edit data in database by same form
        function editData(id) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/teacher/edit/' + id,
                success: function (data) {
                    $('#addT').hide();
                    $('#add ').hide();
                    $('#updateT').show();
                    $('#update').show();
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#subject').val(data.subject);
                }
            })
        }

        // update data in database
        function updateData() {
            var id = $('#id').val();
            var name = $('#name').val();
            var subject = $('#subject').val();
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {name: name, subject: subject},
                url: "/teacher/update/" + id,
                success: function (data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'update successfully'
                    })
                    $('#addT').show();
                    $('#add ').show();
                    $('#updateT').hide();
                    $('#update').hide();
                    clearData();
                    allData();
                },
                error: function (error) {
                    $('#nameError').text(error.responseJSON.errors.name);
                    $('#subjectError').text(error.responseJSON.errors.subject);
                }
            })
        }

        //delete data
        function deleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "/teacher/delete/" + id,
                        success: function (data) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'delete teacher successfully'
                            })
                            clearData();
                            allData();
                        }
                    })
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
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
                        data = data + "<td>" + value.title + "</td>"
                        data = data + "<td>" + value.start + "</td>"
                        data = data + "<td>" + value.end + "</td>"
                        data = data + "<td>"
                        data = data + "<button class='btn btn-sm btn-primary m-2' onclick='getBooking(" + value.id + ")'>{{__('Booking')}}</button>"
                        data = data + "<button class='btn btn-sm btn-primary m-2' onclick='viewAppointment(" + value.id + ")'>{{__('View')}}</button>"

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
            $('#detailsError').hide();
            $('#subjectError').hide();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "getBooking/" + id,
                success: function (response) {
                    console.log(response)

                    var data = '';
                    // $.each(response, function (key, value) {
                    data = data + "<div class='form-group'>"
                    data = data + "<div class ='form-control>"
                    data = data + "<label class ='form-lable'>{{__('Subject')}}</label>"
                    data = data + "<input type='text' id='subject' class='form-control' />"
                    data = data + "</div>"
                    data = data + "<div class ='form-control>"
                    data = data + "<label class ='form-lable'>{{__('Details')}}</label>"
                    data = data + "<input type='textarea' id='subject' class='form-control' />"
                    data = data + "</div>"
                    data = data + "<div class='modal-footer'>"
                    data = data + "<button class='btn btn-lg p-1 btn-primary m-auto' onclick='Booking(" + id + ")'>{{__('Booking')}}</button>"
                    data = data + "</div>"
                    data = data + "</div>"
                    // })

                    $('.modalA').html(data);
                }
            })
        }

        function Booking(id) {
            alert(id);
        }
    </script>
@endsection
