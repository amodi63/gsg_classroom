<?php

namespace App\Providers;

use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
     
      Relation::enforceMorphMap([
        'classwork' => Classwork::class,
      ]);

        Validator::extend('filter', function($attribute, $value, $params){
            return  !(in_array(strtolower($value),$params));
         }, 'This value is not allowed');
    }
}
