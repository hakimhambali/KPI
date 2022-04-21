<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Unit_;
use App\Models\Position_;
use App\Models\Department_;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('layouts.navbars.auth.nav', function ($view) {
            $view->with('user', User::find(auth()->user()->id) );
        });
        View::composer('livewire.auth.sign-up', function ($view) {
            $view->with('position', Position_::all() );
        });
        View::composer('livewire.auth.sign-up', function ($view) {
            $view->with('department', Department_::all() );
        });
        View::composer('livewire.auth.sign-up', function ($view) {
            $view->with('unit', Unit_::all() );
        });
    }
}
