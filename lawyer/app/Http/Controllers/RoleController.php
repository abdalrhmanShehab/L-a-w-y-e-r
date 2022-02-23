<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:get roles|create role|edit role|delete role |show role', ['only' => ['index','store','show']]);
        $this->middleware('permission:create role', ['only' => ['create','store']]);
//        $this->middleware('permission:show role', ['only' => ['show']]);
        $this->middleware('permission:edit role', ['only' => ['edit','update']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $page = 'Role Managment';
        $username = Auth::user()->name;
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('roles.index',compact('roles','username','page'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $page = 'Role Managment';
        $username = Auth::user()->name;
        $permission = Permission::get();
        return view('roles.create',compact('permission','username','page'));
    }


    public function store(Request $request)
    {
        $page = 'Role Managment';
        $username = Auth::user()->name;
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')->with(['username'=> $username,'page'=>$page])
            ->with('success','Role created successfully');
    }

    public function show($id)
    {
        $page = 'Role Managment';

        $username = Auth::user()->name;
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions','username','page'));
    }


    public function edit($id)
    {
        $page = 'Role Managment';

        $username = Auth::user()->name;
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit',compact('role','permission','rolePermissions','username','page'));
    }


    public function update(Request $request, $id)
    {
        $page = 'Role Managment';

        $username = Auth::user()->name;
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')->with(['username'=>$username,'page'=>$page])
            ->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        Role::where('id',$id)->delete();
        return redirect()->route('roles.index')
            ->with('success','Role deleted successfully');
    }
}
