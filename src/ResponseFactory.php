<?php

namespace Framework;

class ResponseFactory
{
    private \Twig\Environment $twig;
    public function __construct(string $debugMode, string $viewsPath)
    {
        $loader = new \Twig\Loader\FilesystemLoader($viewsPath);
        $this->twig = new \Twig\Environment($loader, [
            'debug' => $debugMode
        ]);
    }
    public function body(string $body): Response
    {
        $response = new Response();
        $response->responseCode = 200;
        $response->body = $body;
        return $response;
    }
    public function view(string $template, mixed $parameters): Response
    {
        $response = new Response();
        $response->responseCode = 200;
        $response->body = $this->twig->render($template, $parameters);
        return $response;
    }

    public function notFound(): Response
    {
        $response = new Response();
        $response->responseCode = 404;
        $response->body = $this->twig->render('404.html.twig', []);
        return $response;
    }
}
