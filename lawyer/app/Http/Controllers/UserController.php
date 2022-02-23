<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:get users|create user|edit user|delete user |show user', ['only' => ['index','store']]);
        $this->middleware('permission:create user', ['only' => ['create','store']]);
        $this->middleware('permission:edit user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        $username = Auth::user()->name;
        $page = 'User Managment';
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data','username','page'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $page = 'User Managment';
        $username = Auth::user()->name;
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles','username','page'));
    }


    public function store(CreateUserRequest $request)
    {
        $username = Auth::user()->name;

        $page = 'User Managment';

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User created successfully')->with(['username'=> $username,'page'=>$page]);
    }


    public function show($id)
    {
        $page = 'UserManagment';
        $username = Auth::user()->name;
        $user = User::find($id);
        return view('users.show',compact('user','username','page'));
    }


    public function edit($id)
    {
        $page = 'User Managment';
        $username = Auth::user()->name;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole','username','page'));
    }


    public function update(UpdateUserRequest $request, $id)
    {
        $username = Auth::user()->name;
        $page = 'User Managment';

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with(['username'=>$username,'page'=>$page])
            ->with('success','User updated successfully');
    }


    public function destroy($id)
    {
        $username = Auth::user()->name;
        User::where('id',$id)->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}
