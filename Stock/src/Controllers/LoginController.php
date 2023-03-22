<?php

namespace Controllers;

class LoginController
{
    private $view;
    private $dao;

    public function __construct($dao, $view)
    {
        $this->view = $view;
        $this->dao = $dao;
    }

    public function main()
    {
        $this->view->renderHtml('login.php', []);
    }

    public function login($login, $password)
    {
        $result = (mysqli_fetch_assoc(($this->dao->checkLogin($login, $password))));
        if($result != null) {
            $userId = (int) ($result['id']);
            return $userId;
        } else
            echo "<script>alert(\"Bad login/password\");</script>";
            return -1;
    }

    public function registerForm()
    {
        $this->view->renderHtml('registration.php', []);
    }

    public function register($login, $password, $passwordSecond)
    {
        if($password == $passwordSecond) {
            $idUser = $this->dao->createUser($login, $password);
            $this->dao->createTable($idUser);
            $this->main();
        } else {
            $this->registerForm();
            echo "<script>alert(\"Bad second password\");</script>";
        }
    }

    public function exit()
    {
        $this->main();
    }

}

?>