<form @if (isset($permission)) action="{{ route($baseroute . 'permission.edit', ['permission' => $permission->name]) }}" @else action="{{ route($baseroute . 'permission.create') }}" @endif method="post">
	@csrf
	<div class="row">
		<x-formcomponents::input id="name" :name="trans('crudpermissions::permission.permission')" :value="old('name', isset($permission) ? $permission->name : '')" />
		<x-formcomponents::button>
			@if (isset($permission))
				{{ trans('crudpermissions::permission.update') }}
			@else
				{{ trans('crudpermissions::permission.create') }}
			@endif
		</x-formcomponents::button>
	</div>
</form>