<?php
namespace App\Controllers;

use App\Model\PaginationQuery;
use App\Model\TaskData;
use App\Repository\TaskRepositoryInterface;
use App\Service\AuthenticationServiceInterface;
use App\Service\TaskServiceInterface;
use App\Validator\TaskValidator;
use Framework\Renderer\RenderEngineInterface;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller {
    private TaskValidator $validator;
    private AuthenticationServiceInterface $authenticationService;
    private TaskServiceInterface $service;

    public function __construct(
        RenderEngineInterface $renderEngine,
        TaskServiceInterface $service,
        TaskValidator $validator,
        AuthenticationServiceInterface $authenticationService
    ) {
        parent::__construct($renderEngine, $authenticationService);
        $this->validator = $validator;
        $this->authenticationService = $authenticationService;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = PaginationQuery::fromRequest($request);
        $response = $this->service->listTasks($query);
        $content = $this->renderEngine->render('index.html.twig', ['response' => $response]);

        return $this->response($content, 200);
    }

    public function create(Request $request)
    {
        $content = $this->renderEngine->render('new.html.twig');

        return $this->response($content, 200);
    }

    public function edit(Request $request, int $id)
    {
        $task = $this->service->find($id);
        $content = $this->renderEngine->render('edit.html.twig', ['task' => $task]);

        return $this->response($content, 200);
    }

    public function store(Request $request)
    {
        $errors = [];

        if (!$this->validator->validate($request, $errors)) {
            $content = $this->renderEngine->render('new.html.twig', ['errors' => $errors]);
            return $this->response($content, 200);
        }

        $data = TaskData::fromRequest($request);
        $this->service->create($data);

        return $this->redirect("/");
    }

    public function update(Request $request, int $id)
    {
        $errors = [];

        if (!$this->validator->validate($request, $errors)) {
            $task = $this->service->find($id);
            $content = $this->renderEngine->render('edit.html.twig', ['task' => $task, 'errors' => $errors]);

            return $this->response($content, 200);
        }
        $data = TaskData::fromRequest($request);
        $this->service->update($id, $data);

        return $this->redirect("/");
    }
}
