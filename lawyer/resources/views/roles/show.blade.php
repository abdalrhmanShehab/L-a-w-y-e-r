@extends('layouts.admin.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Role</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-dark btn-lg" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row my-4">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="disabledTextInput" class="form-label">Name</label>
                <li class="list-group-item list-group-item-dark">  {{ $role->name }}</li>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="disabledTextInput" class="form-label">Permissions</label>
                @if(!empty($rolePermissions))
                        <ul class="list-group">
                    @foreach($rolePermissions as $v)
                            <li class="list-group-item">{{$v->name}}</li>
                    @endforeach
                        </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
