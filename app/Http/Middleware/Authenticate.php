<?php

namespace App\Http\Middleware;

use Flasher\Laravel\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if ($request->is(LaravelLocalization::getCurrentLocale() . '/student/dashboard')) {
                return route('selection');
            } elseif($request->is(LaravelLocalization::getCurrentLocale() . '/teacher/dashboard')) {
                return route('selection');
            } elseif($request->is(LaravelLocalization::getCurrentLocale() . '/parent/dashboard')) {
                return route('selection');
            } else {
                return route('selection');
            }
        }
    }
}
