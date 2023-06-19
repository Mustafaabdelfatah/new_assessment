<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\Position;
use App\Enums\UsersTypesEnums;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PositionTreeRepositry;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::if('checkAdmin', function () {
            if(Auth::user()->type == UsersTypesEnums::ADMIN){
                return true;
            }
            else{
                return false;
            }
        });
    }
}
