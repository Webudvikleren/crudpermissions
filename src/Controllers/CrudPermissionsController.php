<?php

namespace Webudvikleren\CrudPermissions\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CrudPermissionsController extends Controller
{
	protected string $baseroute = 'admin.crudpermissions.';
	protected array $breadcrumbs = [];

	public function index()
	{
		$permissions = Permission::get();
		$roles = Role::get();
		return view('crudpermissions::index')
				->with('baseroute', $this->baseroute)
				->with('breadcrumbs', $this->breadcrumbs)
				->with('permissions', $permissions)
				->with('roles', $roles);
	}

	public function toggle($role, $permission)
	{
		$permission = Permission::where('name', $permission)->firstOrFail();
		$role = Role::where('name', $role)->firstOrFail();

		if ($role->hasPermissionTo($permission->name))
		{
			$role->revokePermissionTo($permission->name);
		}
		else
		{
			$role->givePermissionTo($permission->name);
		}

		session()->flash('success', trans('crudpermissions::permission.updated'));
		return redirect()->route($this->baseroute . 'index');
	}
}
