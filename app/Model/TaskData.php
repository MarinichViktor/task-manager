<?php


namespace App\Model;


use Symfony\Component\HttpFoundation\Request;

class TaskData
{
    public string $name;
    public string $email;
    public string $description;
    public int $completed = 0;

    public static function fromRequest(Request $request)
    {
        $task = new TaskData();
        $task->name = $request->get('name');
        $task->email = $request->get('email');
        $task->description = $request->get('description');
        $task->completed = $request->get('completed') ? 1 : 0;

        return $task;
    }
}
