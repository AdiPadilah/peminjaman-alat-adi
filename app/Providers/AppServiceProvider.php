<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Listeners\CatatLogout;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\User;
use App\Observers\LogObserver;

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
        Paginator::useBootstrapFive();

        Event::listen(Logout::class, CatatLogout::class);

        Kategori::observe(LogObserver::class);
        Alat::observe(LogObserver::class);
        User::observe(LogObserver::class);
    }
}
