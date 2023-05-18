<?php

namespace Gd\TenantFilter;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use App\Models\Tenant;
use Gd\TenantFilter\Requests\TenantFilterStoreRequest;

class TenantFilter extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('tenant-filter', __DIR__.'/../dist/js/tool.js');
        Nova::style('tenant-filter', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the menu that renders the navigation links for the tool.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function menu(Request $request)
    {
        return MenuSection::make('Настройки')
            ->path('/tenant-filter')
            ->icon('server');
    }

    public function getTenants()
    {
        $tenants = Tenant::get();
        return response()->json($tenants);
    }

    public function getGlobalTenantFilter()
    {
        $globalTenantFilter = \Session::get('globalTenantFilter');
        return response()->json($globalTenantFilter);
    }

    public function setGlobalTenantFilter(TenantFilterStoreRequest $request)
    {
        \Session::put('globalTenantFilter', $request->input('tenant_id'));
    }
}
