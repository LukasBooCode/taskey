<?php

namespace Framework;

class Kernel
{
    public function __construct()
    {
    }
    public function handle(Request $request): Response
    {
        $response = new Response($request->path);
        return $response;
    }
}
