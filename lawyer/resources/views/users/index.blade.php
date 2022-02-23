@extends('layouts.admin.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            @can('create user')
            <div class="pull-right">
                <a class="btn btn-outline-dark btn-lg" href="{{ route('users.create') }}"> Create New User</a>
            </div>
            @endcan
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 10%">No</th>
                <th style="width: 20%">Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 20%">Role</th>
                <th style="width: 30%">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @can('view user')
                            <a class="btn btn-outline-dark mx-2" href="{{ route('users.show',$user->id) }}">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        @endcan
                        @can('edit user')
                            <a class="btn btn-outline-dark mx-2" href="{{ route('users.edit',$user->id) }}">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        @endcan
                        @can('delete user')
                            <form method="POST" action="{{route('users.destroy',$user->id)}}" class="d-inline">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE" class="d-inline">
                                <button type="submit" class="btn btn-outline-dark mx-2">
                                    <i class="fa fa-trash d-inline"></i>
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tr>



            </tbody>
        </table>
        {!! $data->links() !!}
    </div>
@endsection
