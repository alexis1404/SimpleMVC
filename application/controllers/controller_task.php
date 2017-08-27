<?php

class Controller_task extends Controller
{
    function __construct()
    {
        $this->model = new Model_task();
        $this->view = new View();
    }

    function action_returnAllTasks()
    {
        $data = $this->model->getAllTasks();
        $this->view->generate('task_view.php', 'jsonresponse_view.php', $data);
    }

    function action_returnTaskById()
    {
        $idTask = (string)$_POST['idTask'];

        $data = $this->model->getTaskById($idTask);
        $this->view->generate('task_view.php', 'jsonresponse_view.php', $data);
    }

    function action_createNewTask()
    {
        $username = (string)$_POST['username'];
        $email = (string)$_POST['email'];
        $taskDescription = (string)$_POST['taskDescription'];
        $imagePath = (string)$_POST['imagePath'];

        $data = $this->model->createNewTaskInDatabase($username, $email, $taskDescription, $imagePath);
        $this->view->generate('task_view.php', 'jsonresponse_view.php', $data);
    }

    function action_deleteTask()
    {
        $idTask = (string)$_POST['idTask'];

        $data = $this->model->deleteTask($idTask);
        $this->view->generate('task_view.php', 'jsonresponse_view.php', $data);
    }

    function action_editTask()
    {
        $idTask = (string)$_POST['idTask'];
        $username = (string)$_POST['username'];
        $email = (string)$_POST['email'];
        $taskDescription = (string)$_POST['taskDescription'];
        $imagePath = (string)$_POST['imagePath'];
        $taskStatus = (boolean)$_POST['taskStatus'];

        $data = $this->model->editTask($idTask, $username, $email, $taskDescription, $imagePath, $taskStatus);
        $this->view->generate('task_view.php', 'jsonresponse_view.php', $data);
    }

}