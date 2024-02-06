
Based on [Spatie/Laravel-Permission](https://spatie.be/docs/laravel-permission/v6/introduction). CRUD for permissions and roles. Currently doesn't include adding roles to users. 

```
composer require webudvikleren/crudpermissions
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Put something like this in your `routes\web.php`:

```
Route::name('admin.crudpermissions.')->prefix('permissions')->group(function () {
	Route::controller(AdminCrudPermissionsController::class)->group(function () {
		Route::get('', 'index')->name('index');
		Route::get('toggle/{role}/{permission}', 'toggle')->name('toggle');
	});

	Route::controller(AdminCrudPermissionsPermissionController::class)->name('permission.')->prefix('tilladelse')->group(function () {
		Route::get('opret', 'create')->name('create');
		Route::post('opret', 'store');
		Route::get('{permission}/rediger', 'edit')->name('edit');
		Route::post('{permission}/rediger', 'update');
		Route::get('{permission}/slet', 'delete')->name('delete');
	});

	Route::controller(AdminCrudPermissionsRoleController::class)->name('role.')->prefix('rolle')->group(function () {
		Route::get('opret', 'create')->name('create');
		Route::post('opret', 'store');
		Route::get('{role}/rediger', 'edit')->name('edit');
		Route::post('{role}/rediger', 'update');
		Route::get('{role}/slet', 'delete')->name('delete');
	});
});
```