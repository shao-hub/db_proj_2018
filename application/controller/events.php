<?php


class Events extends Controller
{

    public function index()
    {
        // load a model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $events_model = $this->loadModel('EventsModel');
        $events = $events_model->getAllEvents();

        // load another model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        //$stats_model = $this->loadModel('StatsModel');
        //$amount_of_songs = $stats_model->getAmountOfSongs();

        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/events/index.php';
        require 'application/views/_templates/footer.php';
    }

    private function redirectToHome()
    {
        header('location: ' . URL . 'events/index');
        exit();
    }



    public function add()
    {
        if(!Auth::isAdmin())
            $this->redirectToHome();

        if (isset($_POST["submit_add_event"])) {
            // load model, perform an action on the model
            $events_model=$this->loadModel('EventsModel');
            $events_model->addEvent($_POST["name"], $_POST["date"],  $_POST["team_limit"],$_POST["team_size_limit"]);
            $this->redirectToHome();
        }

        require 'application/views/_templates/header.php';
        require 'application/views/events/add.php';
        require 'application/views/_templates/footer.php';
    }


    public function edit($event_id)
    {
        if(!Auth::isAdmin())
            $this->redirectToHome();

        // if we have POST data to create a new song entry
        if (isset($_POST["submit_edit_event"])) {
            // load model, perform an action on the model
            $events_model=$this->loadModel('EventsModel');
            $events_model->editEvent($event_id,$_POST["name"], $_POST["date"],  $_POST["team_limit"],$_POST["team_size_limit"]);
            $this->redirectToHome();
        }

        require 'application/views/_templates/header.php';
        require 'application/views/events/edit.php';
        require 'application/views/_templates/footer.php';
    }

    public function delete($event_id)
    {
        if(!Auth::isAdmin())
            $this->redirectToHome();


        if (Auth::isAdmin()&&isset($event_id))
        {
            $anncs_model=$this->loadModel('EventsModel');
            $anncs_model->deleteEvent($event_id);
        }

        $this->redirectToHome();
    }

    public function status()
    {
        if(!Auth::isAdmin())
            $this->redirectToHome();

        require 'application/views/_templates/header.php';

        $events_model = $this->loadModel('EventsModel');
        $events = $events_model->getAllEvents();

        foreach($events as $event)
        {

            require 'application/views/events/status_header.php';

            $teams=$events_model->getAllTeams($event->id);
            foreach($teams as $team)
            {

                $members=$events_model->getAllTeamMembers($team->id);

                require 'application/views/events/status_member.php';

            }

            require 'application/views/events/status_footer.php';

        }

        require 'application/views/_templates/footer.php';

    }

    public function signup($event_id)
    {
        if(!Auth::isLogin())
            $this->redirectToHome();

        $events_model = $this->loadModel('EventsModel');
        $event_info=$events_model->getEvent($event_id);

        $err_msg=null;

        if(isset($_SESSION['signup'])
            &&is_array($_SESSION['signup'])
            &&isset($_SESSION['signup']['event_id'])
            &&$_SESSION['signup']['event_id']!=$event_id)
        {
            unset($_SESSION['signup']);
        }

        if(!isset($_SESSION['signup']))
        {
            $_SESSION['signup']=array();
            $_SESSION['signup']['event_id']=$event_id;
        }

        if(!isset($_SESSION['signup']['player_added']))
            $_SESSION['signup']['player_added']=array();

        if(isset($_POST['submit_add_team']))
        {
            $events_model->addTeam($_POST['name'],$event_id,$_SESSION['signup']['player_added']);
            unset($_SESSION['signup']);
            $this->redirectToHome();
        }

        if (isset($_POST["submit_add_player"]))
        {
            $player_info=$events_model->getAccount($_POST["id"]);
            if(!$player_info)
            {
                $err_msg="cannot find player ".$_POST["id"];
            }
            else
            {
                if(array_key_exists($_POST["id"],$_SESSION['signup']['player_added']))
                {
                    $err_msg="player ".$_POST["id"]." is already added";
                }
                else
                {
                    $_SESSION['signup']['player_added'][$_POST["id"]]=$player_info->name;
                }
            }

        }

        require 'application/views/_templates/header.php';
        require 'application/views/events/signup_header.php';
        require 'application/views/events/signup_showplayers.php';
        if(count($_SESSION['signup']['player_added'])<$event_info->team_size_limit)
            require 'application/views/events/signup_addplayer.php';
        require 'application/views/events/signup_footer.php';
        require 'application/views/_templates/footer.php';
    }
}
