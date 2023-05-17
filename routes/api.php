<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Tenant;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/tenants', function () {
    $data['tenants'] = Tenant::get();
    $data['globalTenantFilter'] = Session::get('globalTenantFilter');
    return response()->json($data);
});

Route::post('/set-global-tenant-filter', function (Request $request) {

    $request->validate([
        'globalTenantFilter' => 'required',
    ]);

    Session::put('globalTenantFilter', $request->input('globalTenantFilter'));
});
