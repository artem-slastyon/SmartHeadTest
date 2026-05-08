<?php

namespace App\Providers;

use App\Contracts\UserServiceInterface;
use App\Services\UserService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserServiceInterface::class, function (Application $app) {
            return new UserService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        $responseCallback = function () {
            return response()->json([
                'status' => 'ratelimited'
            ], 429);
        };

        RateLimiter::for('tickets', function (Request $request) use ($responseCallback) {
            return [
                Limit::perDay(1)->by($request->input('email'))->response($responseCallback),
                Limit::perDay(1)->by($request->input('phone'))->response($responseCallback)
            ];
        });
    }
}
