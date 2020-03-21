<?php
namespace App\Controllers;

use App\Service\AuthenticationServiceInterface;
use Framework\Renderer\RenderEngineInterface;
use Symfony\Component\HttpFoundation\Response;


class Controller {
    protected RenderEngineInterface $renderEngine;
    protected AuthenticationServiceInterface $authenticationService;

    public function __construct(
        RenderEngineInterface $renderEngine,
        AuthenticationServiceInterface $authenticationService
    ) {
        $this->renderEngine = $renderEngine;
        $this->authenticationService = $authenticationService;
        $this->renderEngine->addGlobal('user', $this->authenticationService->currentUser());
    }

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
