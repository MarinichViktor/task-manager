<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;


class Controller {
    /**
     * @param string $content
     * @param int $status
     * @param array $headers
     *
     * @return Response
     */
    public function response(string $content, int $status = 200, array $headers = []): Response
    {
        return new Response($content, $status, $headers);
    }

    /**
     * @param string $location
     *
     * @return Response
     */
    public function redirect(string $location): Response
    {
        return new Response(null, 301, ['Location' => $location]);
    }
}
