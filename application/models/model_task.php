<?php

class Model_task extends Model
{
    private $id;
    private $username;
    private $email;
    private $taskDescription;
    private $imagePath;
    private $taskStatus;

    //get- & set- methods
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getTaskDescription()
    {
        return $this->taskDescription;
    }

    public function setTaskDescription($taskDescription)
    {
        $this->taskDescription = $taskDescription;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function getTaskStatus()
    {
        return $this->taskStatus;
    }

    public function setTaskStatus($taskStatus)
    {
        $this->taskStatus = $taskStatus;
    }

    //service methods for direct work with the database
    public function getAllTasks()
    {
        $pdo = $this->getPDO();

        $tmp = $pdo->query("SELECT * FROM TODO;");

        return $tmp->fetchAll();
    }

    public function getTaskById($idTask)
    {
        $pdo = $this->getPDO();

        $tmp = $pdo->query("SELECT * FROM TODO WHERE id= $idTask;");

        return $tmp->fetchAll();
    }

    public function createNewTaskInDatabase($username, $email, $taskDescription, $imagePath)
    {
        $pdo = $this->getPDO();

        $tmp = $pdo->prepare("INSERT INTO TODO (username, email, task_description, image_path, task_status) 
                              VALUES (:username, :email, :task_description, :image_path, 0);");

        $tmp->execute(['username' => $username, 'email' => $email, 'task_description' => $taskDescription, 'image_path' => $imagePath]);

        return true;
    }

    public function deleteTask($idTask)
    {
        $pdo = $this->getPDO();

        $tmp = $pdo->prepare("DELETE FROM TODO WHERE id= :id_delete_task;");

        $tmp->execute(['id_delete_task' => $idTask]);

        return true;
    }

    public function editTask($idTask, $username, $email, $taskDescription, $imagePath, $taskStatus)
    {
        $pdo = $this->getPDO();

        $tmp = $pdo->prepare("UPDATE TODO SET username= :username, email = :email, task_description = :task_description,
                            image_path = :image_path, task_status = :task_status WHERE id= :idTask;");

        $tmp->execute(['idTask' => $idTask, 'username' => $username, 'email' => $email,
            'task_description' => $taskDescription, 'image_path' => $imagePath, 'task_status' => $taskStatus]);

        return true;
    }

    //TEST: Database + Model`s objects
    public function getTaskAsObjectById($idTask)
    {
        $pdo = $this->getPDO();

        $tmp = $pdo->query("SELECT * FROM TODO WHERE id= $idTask;");

        $dataTask =  $tmp->fetchAll();

        $actualTask = new Model_task();

        $actualTask->setId($dataTask[0]['id']);
        $actualTask->setUsername($dataTask[0]['username']);
        $actualTask->setEmail($dataTask[0]['email']);
        $actualTask->setTaskDescription($dataTask[0]['task_description']);
        $actualTask->setImagePath($dataTask[0]['image_path']);
        $actualTask->setTaskStatus($dataTask[0]['task_status']);

        return $actualTask;
    }

    public function saveThisTaskInDatabase()
    {
        if($this->id){

            if (!$this->username) {
                throw new Exception('Value Usrname is empty!');
            }

            if (!$this->email) {
                throw new Exception('Value Email is empty!');
            }

            if (!$this->taskDescription) {
                throw new Exception('Value Task Description is empty!');
            }

            return $this->editTask($this->id, $this->username, $this->email, $this->taskDescription, $this->imagePath, $this->taskStatus);

        }else {

            if (!$this->username) {
                throw new Exception('Value Usrname is empty!');
            }

            if (!$this->email) {
                throw new Exception('Value Email is empty!');
            }

            if (!$this->taskDescription) {
                throw new Exception('Value Task Description is empty!');
            }

            $pdo = $this->getPDO();

            $tmp = $pdo->prepare("INSERT INTO TODO (username, email, task_description, image_path, task_status) 
                              VALUES (:username, :email, :task_description, :image_path, :task_status);");

            $tmp->execute(['username' => $this->username, 'email' => $this->email,
                'task_description' => $this->taskDescription, 'image_path' => $this->imagePath, 'task_status' => (boolean)$this->taskStatus]);

            return true;
        }
    }

}