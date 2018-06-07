<?php

/**
 * Class Songs
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Anncs extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function index()
    {
        // load a model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $anncs_model = $this->loadModel('AnncsModel');
        $anncs = $anncs_model->getAllAnncs();

        // load another model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        //$stats_model = $this->loadModel('StatsModel');
        //$amount_of_songs = $stats_model->getAmountOfSongs();

        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/anncs/index.php';
        require 'application/views/_templates/footer.php';
    }



    public function add()
    {
        if(!Auth::isAdmin())
        {
            header('location: ' . URL . 'anncs/index');
            exit();
        }

        // if we have POST data to create a new song entry
        if (isset($_POST["submit_add_anncs"])) {
            // load model, perform an action on the model
            $anncs_model=$this->loadModel('AnncsModel');
            $anncs_model->addAnnc($_POST["title"], $_POST["date"],  $_POST["description"]);
            header('location: ' . URL . 'anncs/index');
            exit();
        }

        require 'application/views/_templates/header.php';
        require 'application/views/anncs/add.php';
        require 'application/views/_templates/footer.php';
    }


    public function delete($annc_id)
    {
        if(!Auth::isAdmin())
        {
            header('location: ' . URL . 'anncs/index');
            return;
        }


        if (Auth::isAdmin()&&isset($annc_id))
        {
            $anncs_model=$this->loadModel('AnncsModel');
            $anncs_model->deleteAnnc($annc_id);
        }

        header('location: ' . URL . 'anncs/index');
    }

    public function getDetail($annc_id)
    {
        // if we have POST data to create a new song entry

        $anncs_model = $this->loadModel('AnncsModel');
        $annc = $anncs_model->getAnnc($annc_id);

        require 'application/views/_templates/header.php';
        require 'application/views/anncs/detail.php';
        require 'application/views/_templates/footer.php';
    }
}
