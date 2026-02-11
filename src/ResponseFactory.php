<?php

namespace Framework;

class ResponseFactory
{
    public function body(string $text): Response
    {
        $response = new Response($text);
        return $response;
    }
    public function notFound(): Response
    {
        $response = new Response("Page not found", 404);
        return $response;
    }
}
