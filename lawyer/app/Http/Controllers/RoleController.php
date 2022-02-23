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
        $username = Auth::user()->name;
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('roles.index',compact('roles','username'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $username = Auth::user()->name;
        $permission = Permission::get();
        return view('roles.create',compact('permission','username'));
    }


    public function store(Request $request)
    {
        $username = Auth::user()->name;
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')->with('username', $username)
            ->with('success','Role created successfully');
    }

    public function show($id)
    {
        $username = Auth::user()->name;
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions','username'));
    }


    public function edit($id)
    {
        $username = Auth::user()->name;
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit',compact('role','permission','rolePermissions','username'));
    }


    public function update(Request $request, $id)
    {
        $username = Auth::user()->name;
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')->with('username',$username)
            ->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        Role::where('id',$id)->delete();
        return redirect()->route('roles.index')
            ->with('success','Role deleted successfully');
    }
}
