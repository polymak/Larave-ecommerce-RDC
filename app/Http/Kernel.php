<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Middlewares globaux...

 
    ];

    protected $middlewareGroups = [
        'web' => [
            // Middlewares pour le groupe web...
           
        ],

        'api' => [
            // Middlewares pour le groupe API...
        ],
    ]; 
    
    protected $routeMiddleware = [
        
    ];
}
