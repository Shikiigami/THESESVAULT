<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        Validator::extend('ends_with', function ($attribute, $value, $parameters, $validator) {
            return Str::endsWith($value, $parameters[0]);
        });
        
        Validator::extend('email_domain', function ($attribute, $value, $parameters, $validator) {
            return strpos($value, '@psu.palawan.edu.ph') !== false;
        });
    
        Validator::replacer('email_domain', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':domain', implode(', ', $parameters), $message);
        });

    }
}
