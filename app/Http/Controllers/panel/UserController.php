<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use DB;

class UserController extends Controller
{
    public function index()
    {
      $users = User::orderBy('id','Desc')->paginate(10);
      return view('panel.user.index',compact('users'));
    }

    public function create()
    {
      $roles = Role::all();
      return view('panel.user.create',compact('roles'));
    }


  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'company' => 'nullable',
      'email' => 'required|email|unique:users,email',
      'phone' => 'nullable|numeric',
      'password' => 'required|min:6',
    ]);

    $user = User::create([
      'name' => $request->name,
      'company' => $request->company,
      'phone' => $request->phone,
      'uuid' => Str::uuid(),
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'status' => $request->status
    ]);
    $user->assignRole($request->role);

    return redirect()->route('castle.user.index')
      ->with('success','User created successfully');
  }

  public function edit($uuid)
  {
    $user = User::where('uuid', $uuid)->first();
    $roles = Role::all();
    return view('panel.user.edit',compact('user','roles'));
  }

  public function update(Request $request, $uuid)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email|unique:users,email,'.$uuid,
      'role' => 'required|array', // Validate that roles are received as an array
    ]);

    $user = User::where('uuid', $uuid)->first();
    $user->name = $request->name;
    $user->company = $request->name;
    $user->phone = $request->phone;
    $user->email = $request->email;
    $user->status = $request->status;
    $user->save();
    $user->syncRoles([$request->role]); // Pass an array of roles to syncRoles

    return redirect()->route('castle.user.index')
      ->with('success','User updated successfully');
  }

  public function destroy($id)
  {
    User::find($id)->delete();
    return redirect()->route('castle.users.index')
      ->with('success','User deleted successfully');
  }

  public function search(Request $request)
  {
    $searchTerm = $request->input('q');

    $users = User::where('name', 'like', '%'.$searchTerm.'%')
      ->orWhere('company', 'like', '%'.$searchTerm.'%')
      ->paginate(10);

    // Arama sonuçlarını göster
    return view('panel.user.index', compact('users'));
  }

  public function assignRole(Request $request, User $user)
  {
    if ($user->hasRole($request->role)) {
      return back()->with('message', 'Role exists.');
    }

    $user->assignRole($request->role);
    return back()->with('message', 'Role assigned.');
  }

  public function removeRole(User $user, Role $role)
  {
    if ($user->hasRole($role)) {
      $user->removeRole($role);
      return back()->with('message', 'Role removed.');
    }

    return back()->with('message', 'Role not exists.');
  }

  public function givePermission(Request $request, User $user)
  {
    if ($user->hasPermissionTo($request->permission)) {
      return back()->with('message', 'Permission exists.');
    }
    $user->givePermissionTo($request->permission);
    return back()->with('message', 'Permission added.');
  }

  public function revokePermission(User $user, Permission $permission)
  {
    if ($user->hasPermissionTo($permission)) {
      $user->revokePermissionTo($permission);
      return back()->with('message', 'Permission revoked.');
    }
    return back()->with('message', 'Permission does not exists.');
  }
}
