@extends('layout.app')
@section('meta_title', trans('crudpermissions::permission.permissions'))

@section('content')
<h1>{{ trans('crudpermissions::permission.permissions') }}</h1>
<x-crudpermissions::status />

<a class="btn btn-light mb-3" href="{{ route($baseroute . 'permission.create') }}">
	<x-bootstrapicons::plus-circle class="me-1" color="green" size="20" />
	{{ trans('crudpermissions::permission.add') }}
</a>
<a class="btn btn-light mb-3" href="{{ route($baseroute . 'role.create') }}">
	<x-bootstrapicons::people class="me-1" color="green" size="20" />
	{{ trans('crudpermissions::role.add') }}
</a>

<table class="mb-4 table table-hover table-list">
	<thead>
		<tr>
			<td>{{ trans('crudpermissions::permission.permission') }}</td>
			<td class="text-center" colspan="{{ $roles->count() }}">{{ trans('crudpermissions::role.role') }}</td>
		</tr>
		<tr>
			<td></td>
			@foreach ($roles as $role)
				<td class="text-center">{{ $role->name }}</td>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach ($permissions as $permission)
			<tr>
				<td>{{ $permission->name }}</td>
				@foreach ($roles as $role)
					<td class="text-center">
						<a href="{{ route($baseroute . 'toggle', ['permission' => $permission->name, 'role' => $role->name]) }}" title="{{ $role->name }} {{ $permission->name }}">
							@if ($role->hasPermissionTo($permission->name))
								<x-bootstrapicons::check-circle color="green" />
							@else
								<x-bootstrapicons::x-circle color="red" />
							@endif
						</a>
					</td>
				@endforeach
			</tr>
		@endforeach
	</tbody>
</table>

<h2>{{ trans('crudpermissions::role.roles') }}</h2>
<table class="mb-4 table table-hover table-list">
	<thead>
		<tr>
			<td>{{ trans('crudpermissions::role.role') }}</td>
			<td colspan="2"></td>
		</tr>
	</thead>
	<tbody>
		@foreach ($roles as $role)
			<tr>
				<td>{{ $role->name }}</td>
				<td class="text-center">
					<a href="{{ route($baseroute . 'role.edit', ['role' => $role->name]) }}" title="{{ trans('crudpermissions::role.edit') }}">
						<x-bootstrapicons::pencil-square />
					</a>
				</td>
				<td class="text-center">
					<a href="{{ route($baseroute . 'role.delete', ['role' => $role->name]) }}" onclick="return confirm('{{ trans('crudpermissions::role.delete.confirm') }}')" title="{{ trans('crudpermissions::role.delete') }}">
						<x-bootstrapicons::trash color="red" />
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<h2>{{ trans('crudpermissions::permission.permissions') }}</h2>
<table class="table table-hover table-list">
	<thead>
		<tr>
			<td>{{ trans('crudpermissions::permission.permission') }}</td>
			<td colspan="2"></td>
		</tr>
	</thead>
	<tbody>
		@foreach ($permissions as $permission)
			<tr>
				<td>{{ $permission->name }}</td>
				<td class="text-center">
					<a href="{{ route($baseroute . 'permission.edit', ['permission' => $permission->name]) }}" title="{{ trans('crudpermissions::permission.edit') }}">
						<x-bootstrapicons::pencil-square />
					</a>
				</td>
				<td class="text-center">
					<a href="{{ route($baseroute . 'permission.delete', ['permission' => $permission->name]) }}" onclick="return confirm('{{ trans('crudpermissions::permission.delete.confirm') }}')" title="{{ trans('crudpermissions::permission.delete') }}">
						<x-bootstrapicons::trash color="red" />
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection