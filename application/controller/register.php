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
                $this->redirectToHome("CAPTCHA required");
                return;
            }
            if (!$register_model->isValidId($_POST["user_id"])) {
                $this->redirectToHome("Invalid user ID");
                return;
            }
            if ($register_model->findAccount($_POST["user_id"])!=FALSE) {
                $this->redirectToHome("User ID already exists");
                return;
            }
            if (strpos($_POST["user_email"], '@') === FALSE) {
                $this->redirectToHome("Invalid email");
                return;
            }
            $register_model->addAccount($_POST["user_id"], $_POST["user_pw"],$_POST["user_name"],$_POST["user_email"] );
            $this->redirectToHome("Registration success!");
        }
    }

    public function checkUserId()
    {

        if(isset($_POST["id"]))
        {
            $obj=new stdClass();
            $obj->valid="false";
            $register_model=$this->loadModel('RegisterModel');
            if(!$register_model->isValidId($_POST["id"])) {
                $obj->valid="invalid";
            }
            else if($register_model->findAccount($_POST["id"])==false)
            {
                $obj->valid="true";
            }
            $JSON=json_encode($obj);
            echo $JSON;
        }
    }

    private function redirectToHome($message = "")
    {
        if ($message !== "") {
            Msg::SetMsg($message);
        }
        header('location: ' . URL . 'anncs/index');
        exit();
    }



}
