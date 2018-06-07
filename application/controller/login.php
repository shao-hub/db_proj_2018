<?php


class Login extends Controller
{

    public function index()
    {
        require 'application/views/_templates/header.php';
        require 'application/views/login/index.php';
        require 'application/views/_templates/footer.php';
    }

    private function redirectToHome()
    {
        header('location: ' . URL . 'anncs/index');
        exit();
    }



    public function loginAccount()
    {
        if (isset($_POST["submit_login_account"])) {
            $login_model=$this->loadModel('LoginModel');
            if($login_model->verifyAccount($_POST["user_id"], $_POST["user_pw"]))
                Msg::SetMsg("Login success");
            else
                Msg::SetMsg("Login failed");
            $this->redirectToHome();
        }
    }

    public function logoutAccount()
    {
        Auth::logout();
        $this->redirectToHome();
    }

}
