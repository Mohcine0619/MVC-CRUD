<?php
require 'models/studentModel.php';

class StudentController {
    private $model;

    public function __construct() {
        $this->model = new StudentModel();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? '';

        switch ($action) {
            case 'add':
                $this->addStudent();
                break;
            case 'edit':
                $this->editStudent();
                break;
            case 'delete':
                $this->deleteStudent();
                break;
            default:
                $this->listStudents();
                break;
        }
    }

    private function addStudent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $this->model->addStudent($name, $email);
            header('Location: index.php');
        } else {
            require 'views/studentView.php';
        }
    }

    private function editStudent() {
        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $this->model->updateStudent($id, $name, $email);
            header('Location: index.php');
        } else {
            $student = $this->model->getStudentById($id);
            require 'views/studentView.php';
        }
    }

    private function deleteStudent() {
        $id = $_GET['id'];
        $this->model->deleteStudent($id);
        header('Location: index.php');
    }

    private function listStudents() {
        $students = $this->model->getAllStudents();
        require 'views/studentView.php';
    }
}
?>