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

    public function delete_signup($event_id)
    {
        if(!Auth::isLogin())
        {
            $this->redirectToHome();
        }

        $events_model = $this->loadModel('EventsModel');

        $joined_teams=$events_model->getUserJoinTeams(Auth::getUserId(),$event_id);

        foreach ($joined_teams as $joined_team)
        {
            $events_model->deleteTeam($joined_team->id,$event_id);
        }

        $this->redirectToHome();
    }

    public function checkUserId()
    {
        if(!Auth::isLogin())
        {
            exit();
        }

        if(isset($_POST["id"]))
        {
            $obj=new stdClass();
            $register_model=$this->loadModel('RegisterModel');
            $result=$register_model->findAccount($_POST["id"]);
            if($result)
            {
                $obj->valid="true";
                $obj->name=$result->name;
            }
            else
            {
                $obj->valid="false";
            }
            $JSON=json_encode($obj);
            echo $JSON;
        }
    }

    public function signup($event_id)
    {
        if(!Auth::isLogin())
            $this->redirectToHome();

        $events_model = $this->loadModel('EventsModel');
        $event_info=$events_model->getEvent($event_id);

        $err_msg=null;

        require 'application/views/_templates/header.php';
        require 'application/views/events/signup.php';
        require 'application/views/_templates/footer.php';
    }

    public function signup_team()
    {
        if(!Auth::isLogin())
        {
            $this->redirectToHome();
        }
        if(isset($_POST["json"]))
        {
            $events_model = $this->loadModel('EventsModel');
            $obj = json_decode($_POST["json"], false);
            $events_model->addTeam($obj->team_name,$obj->event_id,$obj->team_members);
        }

        $obj=new stdClass();
        $obj->valid="true";
        $JSON=json_encode($obj);
        echo $JSON;

    }
}
