<?php
namespace App\Controllers;

use App\Entity\Task;
use App\Repository\TaskRepositoryInterface;
use Framework\Renderer\RenderEngineInterface;

class TaskController extends Controller {
    private RenderEngineInterface $renderEngine;
    private TaskRepositoryInterface $repository;

    public function __construct(RenderEngineInterface $renderEngine, TaskRepositoryInterface $repository)
    {
        $this->renderEngine = $renderEngine;
        $this->repository = $repository;
    }

    public function index()
    {
        $tasks = $this->repository->listTasks();
        $content = $this->renderEngine->render('index.html.twig', ['tasks' => $tasks]);
        return $this->response($content, 200);
    }
}
