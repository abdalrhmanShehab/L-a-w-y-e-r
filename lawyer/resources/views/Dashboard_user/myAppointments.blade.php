@extends('layouts.user.master')
@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-10 m-auto">
            @if($appointments)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('Status')}}</th>
                        <th scope="col">{{__('start')}}</th>
                        <th scope="col">{{__('end')}}</th>
                        <th scope="col">{{__('Lawyer')}}</th>
                        <th scope="col">{{__('Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($appointments as $index =>$appointment)
                        <tr>
                            <td>{{$index +1}}</td>
                            <td style="color:{{$appointment['color']}}">{{$appointment['title']}}</td>
                            <td>{{$appointment['start']}}</td>
                            <td>{{$appointment['end']}}</td>
                            <td>{{$appointment['lawyer']}}</td>
                            <td>
                                <a href="{{route('user.unBooking',$appointment['id'])}}" class="btn btn-danger">{{__('Cancel Appointmet')}}</a>
                            </td>
                        </tr>
                    @empty
                        {{__('there are no Appointment for you')}}
                    @endforelse
                    </tbody>
                </table>
            @else
                <h4 class="justify-content-center m-5 text-center">{{__('There are No Appointment for You')}}</h4>
            @endif
        </div>
    </div>
@endsection
