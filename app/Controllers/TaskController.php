<?php
namespace App\Controllers;

use App\Model\PaginationQuery;
use App\Repository\TaskRepositoryInterface;
use App\Validator\TaskValidator;
use Framework\Renderer\RenderEngineInterface;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller {
    private RenderEngineInterface $renderEngine;
    private TaskRepositoryInterface $repository;

    public function __construct(RenderEngineInterface $renderEngine, TaskRepositoryInterface $repository)
    {
        $this->renderEngine = $renderEngine;
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $query = new PaginationQuery($request->get('limit', 3), $request->get('page', 1));
        $response = $this->repository->listTasks($query);
        $content = $this->renderEngine->render('index.html.twig', ['response' => $response]);

        return $this->response($content, 200);
    }

    public function create(Request $request)
    {
        $content = $this->renderEngine->render('new.html.twig');

        return $this->response($content, 200);
    }

    public function store(Request $request)
    {
        $validator = new TaskValidator();

        if ($errors = $validator->validate($request)) {
            $content = $this->renderEngine->render('new.html.twig', ['errors' => $errors]);
            return $this->response($content, 200);
        }

        return $this->redirect("/");
    }
}
