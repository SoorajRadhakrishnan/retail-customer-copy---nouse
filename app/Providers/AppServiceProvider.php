<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        $this->app->singleton('appSettings',function(){
            return Setting::all()->keyBy('key');
        });

        $this->app->singleton('userPermissions',function(){
            return Permission::getUserPermissions(auth()->user()->id);
        });
    }
}
