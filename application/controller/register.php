<?php


class Register extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */

    public function index()
    {
        echo 'Message from Controller: You are in the Controller: Songs, using the method index().';

        require 'application/views/_templates/header.php';
        require 'application/views/register/index.php';
        require 'application/views/_templates/footer.php';
    }


    public function signup()
    {
        echo 'Message from Controller: You are in the Controller: Register, using the method signup().';

        // if we have POST data to create a new song entry
        if (isset($_POST["submit_signup_account"])) {
            // load model, perform an action on the model
            $anncs_model=$this->loadModel('RegisterModel');
            $anncs_model->addAccount($_POST["user_id"], $_POST["user_pw"],$_POST["user_name"] );
            header('location: ' . URL . 'anncs/index');
        }
    }

}
