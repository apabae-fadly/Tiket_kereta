<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\UserHelper;
use App\Helpers\ValidationHelper;
use App\Helpers\ResponseHelper;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register helper classes
        $this->app->singleton('user.helper', function () {
            return new UserHelper();
        });

        $this->app->singleton('validation.helper', function () {
            return new ValidationHelper();
        });

        $this->app->singleton('response.helper', function () {
            return new ResponseHelper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Pastikan folder cache views ada
        if (!is_dir(storage_path('framework/views'))) {
            mkdir(storage_path('framework/views'), 0777, true);
        }

        // Register Blade directives
        Blade::directive('IsAdmin', function () {
            return "<?php if(\\App\\Helpers\\UserHelper::IsAdmin()): ?>";
        });

        Blade::directive('endIsAdmin', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('isUser', function () {
            return "<?php if(\\App\\Helpers\\UserHelper::isUser()): ?>";
        });

        Blade::directive('endIsUser', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('isLoggedIn', function () {
            return "<?php if(\\App\\Helpers\\UserHelper::isLoggedIn()): ?>";
        });

        Blade::directive('endIsLoggedIn', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('hasRole', function ($role) {
            return "<?php if(\\App\\Helpers\\UserHelper::hasRole($role)): ?>";
        });

        Blade::directive('endHasRole', function () {
            return "<?php endif; ?>";
        });

        // Register helper functions
        if (!function_exists('user_helper')) {
            function user_helper() {
                return app('user.helper');
            }
        }

        if (!function_exists('validation_helper')) {
            function validation_helper() {
                return app('validation.helper');
            }
        }

        if (!function_exists('response_helper')) {
            function response_helper() {
                return app('response.helper');
            }
        }
    }
} 
