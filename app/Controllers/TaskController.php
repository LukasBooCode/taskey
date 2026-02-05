<?php

namespace App\Controllers;

use Framework\Response;

class TaskController
{
    public function index(): Response
    {
        return new Response("These are the Tasks");
    }
    public function create(): Response
    {
        return new Response("Create a new Task");
    }
}
