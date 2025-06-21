<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/*', // Exclude all API routes from CSRF verification



        'cases', // Exclude cases endpoint
        'cases/*', // Exclude all cases related endpoints
        'api/cases', // Exclude API cases endpoint
        'api/cases/*', // Exclude all API cases related endpoints
        'api/register', // Exclude API registration endpoint
        'api/login', // Exclude API login endpoint
    ];
}
