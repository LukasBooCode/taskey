<?php

namespace App\Middleware;

use Framework\Request;
use Framework\Response;

class AuthMiddleware
{
    public function __construct()
    {
    }

    public function requireAccount(Request $request, callable $next)
    {
        if (!$request->session->getAttribute("user")) {
            return new Response("You must be logged in to access this functionality", 403);
        }
        return $next($request);
    }
}
