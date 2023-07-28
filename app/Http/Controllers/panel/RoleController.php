<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class RoleController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  function __construct()
  {
    $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
    $this->middleware('permission:role-create', ['only' => ['create','store']]);
    $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:role-delete', ['only' => ['destroy']]);
  }


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
      $roles = Role::orderBy('id','DESC')->paginate(5);

      return view('panel.user.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
      $permission = Permission::get();
      return view('panel.user.role.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required|unique:roles,name',
        'permission' => 'required',
      ]);

      $role = Role::create(['name' => $request->input('name')]);
      $role->syncPermissions($request->input('permission'));

      return redirect()->route('castle.roles.index')
        ->with('success','Role created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
      $role = Role::find($id);
      $permission = Permission::get();
      $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();

      return view('panel.user.role.edit',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name' => 'required',
        'permission' => 'required',
      ]);

      $role = Role::find($id);
      $role->name = $request->input('name');
      $role->save();

      $role->syncPermissions($request->input('permission'));

      return redirect()->route('castle.roles.index')
        ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
      DB::table("roles")->where('id',$id)->delete();
      return redirect()->route('roles.index')
        ->with('success','Role deleted successfully');
    }

  public function givePermission(Request $request, Role $role)
  {
    if($role->hasPermissionTo($request->permission)){
      return back()->with('message', 'Permission exists.');
    }
    $role->givePermissionTo($request->permission);
    return back()->with('message', 'Permission added.');
  }

  public function revokePermission(Role $role, Permission $permission)
  {
    if($role->hasPermissionTo($permission)){
      $role->revokePermissionTo($permission);
      return back()->with('message', 'Permission revoked.');
    }
    return back()->with('message', 'Permission not exists.');
  }
}
