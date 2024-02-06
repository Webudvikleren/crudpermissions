<?php

namespace Webudvikleren\CrudPermissions\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class CrudPermissionsPermissionController extends Controller
{
	protected string $baseroute = 'admin.crudpermissions.';
	protected array $breadcrumbs = [];

	public function __construct()
	{
		$this->breadcrumbs[] = [trans('crudpermissions::permission.permissions'), route('admin.crudpermissions.index')];
	}

	public function create()
	{
		return view('crudpermissions::permission.create')
				->with('baseroute', $this->baseroute)
				->with('breadcrumbs', $this->breadcrumbs);
	}

	public function delete($permission)
	{
		$permission = Permission::where('name', $permission)->firstOrFail();
		$permission->delete();

		session()->flash('success', trans('crudpermission::permission.deleted'));
		return redirect()->route($this->baseroute . 'index');
	}

	public function edit($permission)
	{
		$permission = Permission::where('name', $permission)->firstOrFail();
		return view('crudpermissions::permission.edit')
				->with('baseroute', $this->baseroute)
				->with('breadcrumbs', $this->breadcrumbs)
				->with('permission', $permission);
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => ['required', 'string', 'unique:Spatie\Permission\Models\Permission,name'],
		], [
			// TODO: fix?
		]);

		Permission::create(['name' => $validated['name']]);

		session()->flash('success', trans('crudpermissions::permission.created'));
		return redirect()->route($this->baseroute . 'index');
	}

	public function update($permission, Request $request)
	{
		$permission = Permission::where('name', $permission)->firstOrFail();
		$validated = $request->validate([
			'name' => [
				'required', 
				'string',
				Rule::unique('permissions')->ignore($permission),
			]
		], [
			// TODO: fix?
		]);

		$permission->name = $validated['name'];
		$permission->save();

		session()->flash('success', trans('crudpermissions::permission.updated'));
		return redirect()->route($this->baseroute . 'index');
	}
}
