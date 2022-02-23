@extends('layouts.admin.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Role Management</h2>
            </div>
            <div class="pull-right">
                @can('create role')
                    <a class="btn btn-outline-dark btn-lg" href="{{ route('roles.create') }}"> Create New Role</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card-body p-0">
        <table class="table">
            <thead>
            <tr>
                <th width="20%">No</th>
                <th width="40%">Name</th>
                <th width="40%">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @can('view role')
                            <a class="btn btn-outline-dark mx-2" href="{{ route('roles.show',$role->id) }}">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        @endcan
                        @can('edit role')
                            <a class="btn btn-outline-dark mx-2" href="{{ route('roles.edit',$role->id) }}">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        @endcan
                        @can('delete role')
                            <form method="POST" action="{{route('roles.destroy',$role->id)}}" class="d-inline mx-2">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE" class="d-inline">
                                <button type="submit" class="btn btn-outline-dark">
                                    <i class="fa fa-trash d-inline"></i>
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach



            </tbody>
        </table>
    {!! $roles->links() !!}
    </div>
@endsection
