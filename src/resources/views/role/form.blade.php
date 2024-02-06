<form @if (isset($role)) action="{{ route($baseroute . 'role.edit', ['role' => $role->name]) }}" @else action="{{ route($baseroute . 'role.create') }}" @endif method="post">
	@csrf
	<div class="row">
		<x-formcomponents::input id="name" :name="trans('crudpermissions::role.role')" :value="old('name', isset($role) ? $role->name : '')" />
		<x-formcomponents::button>
			@if (isset($role))
				{{ trans('crudpermissions::role.update') }}
			@else
				{{ trans('crudpermissions::role.create') }}
			@endif
		</x-formcomponents::button>
	</div>
</form>