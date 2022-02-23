@extends('layouts.admin.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-dark btn-lg" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row my-4">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="disabledTextInput" class="form-label">Name</label>
                <li class="list-group-item list-group-item-dark">  {{ $user->name }}</li>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="disabledTextInput" class="form-label">Email</label>
                <li class="list-group-item list-group-item-dark"> {{ $user->email }}</li>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="disabledTextInput" class="form-label">Roles</label>
                @if(!empty($user->getRoleNames()))
                    <ul class="list-group">
                    @foreach($user->getRoleNames() as $v)
                            <li class="list-group-item">{{$v}}</li>
                    </ul>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
