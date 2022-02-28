@extends('layouts.user.master')
@section('content')
    <div class="row justify-content-center wrapper my-5">
        <div class="card col-10">
            <div class="card-header">
               {{__('Appointments')}}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{__('Please Select lawyer')}}</h5>
                <p class="card-text">{{__('select lawyer to show his appointments')}}</p>
                <div class="form-group">
                    <select name="lawyer" id="lawyer" class="form-control">
                        <option value="" disabled selected>{{__('select lawyer ...')}}</option>
                        @foreach($lawyers as $lawyer)
                         <option data-id="{{$lawyer->id}}" value="{{$lawyer->id}}">{{$lawyer->name}}</option>
                        @endforeach
                    </select>
                </div>
{{--                <a href="{{url('/appointment/getAppointments',$lawyers->id)}}" class="btn btn-primary">{{__('select')}}</a>--}}
                <button onclick="getAppointments()" class="btn btn-primary">{{__('select')}}</button>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function getAppointments(){
            var lawyer_id = $('#lawyer').val();

            $.ajax({
                url : 'appointment/getAppointments/'+lawyer_id,
                type : "POST",
                dataType : 'json',
                data : {
                    'id':lawyer_id,
                },
                success : function (data){
                    alert(data)
                },
                error : function (error){
                    alert(error);
                }
            })
        }
    </script>
@endsection
