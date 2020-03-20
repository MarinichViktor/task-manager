<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;


class Controller {
    public function response(string $content, int $status = 200, array $headers = []): Response
    {
        return new Response($content, $status, $headers);
    }
}
