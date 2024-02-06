<?php

namespace Webudvikleren\CrudPermissions\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class CrudPermissionsRoleController extends Controller
{
	protected string $baseroute = 'admin.crudpermissions.';
	protected array $breadcrumbs = [];

	public function __construct()
	{
		$this->breadcrumbs[] = [trans('crudpermissions::permission.permissions'), route('admin.crudpermissions.index')];
	}

	public function create()
	{
		return view('crudpermissions::role.create')
				->with('baseroute', $this->baseroute)
				->with('breadcrumbs', $this->breadcrumbs);
	}

	public function delete($role)
	{
		$role = Role::where('name', $role)->firstOrFail();
		$role->delete();

		session()->flash('success', trans('crudpermission::role.deleted'));
		return redirect()->route($this->baseroute . 'index');
	}

	public function edit($role)
	{
		$role = Role::where('name', $role)->firstOrFail();
		return view('crudpermissions::role.edit')
				->with('baseroute', $this->baseroute)
				->with('breadcrumbs', $this->breadcrumbs)
				->with('role', $role);
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => ['required', 'string', 'unique:Spatie\Permission\Models\Role,name'],
		], [
			// TODO: fix?
		]);

		Role::create(['name' => $validated['name']]);

		session()->flash('success', trans('crudpermissions::role.created'));
		return redirect()->route($this->baseroute . 'index');
	}

	public function update($role, Request $request)
	{
		$role = Role::where('name', $role)->firstOrFail();
		$validated = $request->validate([
			'name' => [
				'required', 
				'string',
				Rule::unique('roles')->ignore($role),
			]
		], [
			// TODO: fix?
		]);

		$role->name = $validated['name'];
		$role->save();

		session()->flash('success', trans('crudpermissions::role.updated'));
		return redirect()->route($this->baseroute . 'index');
	}
}
