<?php


namespace App\Controllers;


use App\Service\AuthenticationServiceInterface;
use App\Validator\AuthenticationValidator;
use Framework\Renderer\RenderEngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    private AuthenticationServiceInterface $authenticationService;
    private AuthenticationValidator $validator;

    public function __construct(
        AuthenticationServiceInterface $authenticationService,
        RenderEngineInterface $renderEngine,
        AuthenticationValidator $validator
    ) {
        parent::__construct($renderEngine, $authenticationService);
        $this->authenticationService = $authenticationService;
        $this->validator = $validator;
    }

    public function login(Request $request): Response
    {
        $content = $this->renderEngine->render('login.html.twig');

        return $this->response($content, 200);
    }

    public function logout(): Response
    {
        $this->authenticationService->logout();

        return $this->redirect('/');
    }

    public function authenticate(Request $request): Response
    {
        $errors = [];

        if (!$this->validator->validate($request, $errors)) {
            $content = $this->renderEngine->render('login.html.twig', ['errors' => $errors]);
            return $this->response($content, 200);
        }

        if ($this->authenticationService->checkCredentials($request->get('name'), $request->get('password'))) {
            $this->authenticationService->authenticate($request->get('name'));
            return $this->redirect('/');
        }

        $errors = ['name' => ['messages' => ['Name or password is invalid']]];
        $content = $this->renderEngine->render('login.html.twig', ['errors' => $errors]);

        return $this->response($content, 200);
    }
}
