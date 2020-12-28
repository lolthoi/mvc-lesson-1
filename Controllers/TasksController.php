<?php

namespace mvc\Controllers;

use mvc\Core\Controller;

//use mvc\Models\Task;
use mvc\Models\TaskModel;
use mvc\Models\TaskRepository;

class TasksController extends Controller
{
    function index()
    {
        $tasks = new TaskRepository();
        $d['tasks'] = $tasks->getAll();
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"])) {
            $task = new TaskRepository();
            $taskModel = new TaskModel;
            $taskModel->setTitle($_POST["title"]);
            $taskModel->setDescription($_POST["description"]);
            if ($task->add($taskModel)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->render("create");
    }

    function edit($id)
    {
        $task = new TaskRepository();
        $d["task"] = $task->get($id);
        if (isset($_POST["title"])) {
            $taskModel = new TaskModel;
            $taskModel->setId($id);
            $taskModel->setTitle($_POST["title"]);
            $taskModel->setDescription($_POST["description"]);
            if ($task->edit($taskModel)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        $task = new TaskRepository();
        $taskModel = new TaskModel;
        $taskModel->setId($id);
        if ($task->delete($taskModel)) {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
