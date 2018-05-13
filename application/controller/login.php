<?php


class Login extends Controller
{

    public function index()
    {
        require 'application/views/_templates/header.php';
        require 'application/views/login/index.php';
        require 'application/views/_templates/footer.php';
    }


    public function loginAccount()
    {
        if (isset($_POST["submit_login_account"])) {
            $login_model=$this->loadModel('LoginModel');
            $login_model->verifyAccount($_POST["user_id"], $_POST["user_pw"]);
            header('location: ' . URL . 'anncs/index');
        }
    }

    public function logoutAccount()
    {
        Auth::logout();
        header('location: ' . URL . 'anncs/index');

    }

}
