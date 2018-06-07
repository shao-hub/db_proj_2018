<?php


class Register extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */

    public function index()
    {
        require 'application/views/_templates/header.php';
        require 'application/views/register/index.php';
        require 'application/views/_templates/footer.php';
    }



    public function signup()
    {
        // if we have POST data to create a new song entry
        if (isset($_POST["submit_signup_account"]))
        {
            $register_model=$this->loadModel('RegisterModel');
            if($register_model->verifyReCaptcha($_POST['g-recaptcha-response'])==false)
            {
                $this->redirectToHome();
                return;
            }
            $register_model->addAccount($_POST["user_id"], $_POST["user_pw"],$_POST["user_name"],$_POST["user_email"] );
            $this->redirectToHome();
        }
    }

    public function checkUserId()
    {

        if(isset($_POST["id"]))
        {
            $obj=new stdClass();
            $obj->valid="false";
            $register_model=$this->loadModel('RegisterModel');
            if($register_model->findAccount($_POST["id"])==false)
            {
                $obj->valid="true";
            }
            $JSON=json_encode($obj);
            echo $JSON;
        }
    }

    private function redirectToHome()
    {
        header('location: ' . URL . 'anncs/index');
        exit();
    }



}
