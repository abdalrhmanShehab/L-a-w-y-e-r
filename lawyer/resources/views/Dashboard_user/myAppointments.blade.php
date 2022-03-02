@extends('layouts.user.master')
@section('content')
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Status</th>
                    <th scope="col">start</th>
                    <th scope="col">end</th>
                    <th scope="col">Lawyer</th>
                </tr>
                </thead>
                <tbody>
                @foreach($appointments as $index =>$appointment)
                    {{dd($appointments)}}
                    <tr>
                        <td>{{$index}}</td>
                        <td style="color:{{$appointment->color}}">{{$appointment->title}}</td>
                        <td>{{$appointment->start}}</td>
                        <td>{{$appointment->end}}</td>
                        <td>{{$appointment->lawyer_id}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
