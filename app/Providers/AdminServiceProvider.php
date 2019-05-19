<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AdminControllerAssets;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app()->bind(AdminControllerAssets::class, AdminControllerAssets::class);
    }
}
