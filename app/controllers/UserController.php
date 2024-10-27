<?php
require_once 'app/models/User.php';

class UserController {
    private $userModel;

    public function __construct($dbConnection) {
        $this->userModel = new User($dbConnection);
    }

    public function show() {
        return $this->userModel->getAllUsers(); 
    }

    public function detail($id) {
        return $this->userModel->getUserById($id); 
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $this->userModel->editUser($id, $name, $email);
            header('Location: index.php'); 
            exit; 
        } else {
            return $this->userModel->getUserById($id); 
        }
    }

    public function delete($id) {
        $this->userModel->deleteUser($id);
        header('Location: index.php'); 
        exit;
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $this->userModel->addUser($name, $email);
            header('Location: index.php'); 
            exit;
        } else {
            include 'app/views/userAdd.php'; 
        }
    }
}
