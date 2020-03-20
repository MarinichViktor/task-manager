<?php
namespace App\Controllers;

use Framework\Renderer\RenderEngineInterface;
use Symfony\Component\HttpFoundation\Response;

class TaskController {
    private RenderEngineInterface $renderEngine;

    public function __construct(RenderEngineInterface $renderEngine)
    {
        $this->renderEngine = $renderEngine;
    }

    public function index()
    {
        $content = $this->renderEngine->render('index.html.twig', ["title" => 'My dynamic rendered title']);

        return new Response($content, 200);
    }
}
