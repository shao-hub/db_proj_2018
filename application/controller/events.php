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
        if (!Auth::isAdmin())
            $this->redirectToHome();

        if (isset($_POST["submit_add_event"])) {
            // load model, perform an action on the model
            $events_model = $this->loadModel('EventsModel');
            $events_model->addEvent($_POST["name"], $_POST["date"], $_POST["team_limit"], $_POST["team_size_limit"], $_POST["description"]);
            $this->redirectToHome();
        }

        require 'application/views/_templates/header.php';
        require 'application/views/events/add.php';
        require 'application/views/_templates/footer.php';
    }


    public function edit($event_id)
    {
        if (!Auth::isAdmin())
            $this->redirectToHome();

        // if we have POST data to create a new song entry
        if (isset($_POST["submit_edit_event"])) {
            // load model, perform an action on the model
            $events_model = $this->loadModel('EventsModel');
            $events_model->editEvent($event_id, $_POST["name"], $_POST["date"], $_POST["team_limit"], $_POST["team_size_limit"], $_POST["description"]);
            $this->redirectToHome();
        }

        $events_model = $this->loadModel('EventsModel');
        $event = $events_model->getEvent($event_id);
        require 'application/views/_templates/header.php';
        require 'application/views/events/edit.php';
        require 'application/views/_templates/footer.php';
    }

    public function delete($event_id)
    {
        if (!Auth::isAdmin())
            $this->redirectToHome();


        if (Auth::isAdmin() && isset($event_id)) {
            $anncs_model = $this->loadModel('EventsModel');
            $anncs_model->deleteEvent($event_id);
        }

        $this->redirectToHome();
    }

    public function status($event_id = 'all')
    {
        if (!Auth::isAdmin())
            $this->redirectToHome();

        require 'application/views/_templates/header.php';

        $events_model = $this->loadModel('EventsModel');
        if ($event_id == 'all') {
            $events = $events_model->getAllEvents();
        } else {
            $events = [$events_model->getEvent($event_id)];
        }
        foreach ($events as $event) {
            // to prevent error
            if (!ISSET($event->id)) {
                $event = (object)['id' => $event_id];
            }
            $teams = $events_model->getAllTeams($event->id);
            require 'application/views/events/status_header.php';

            foreach ($teams as $team) {

                $members = $events_model->getAllTeamMembers($team->id);

                require 'application/views/events/status_member.php';

            }

            require 'application/views/events/status_footer.php';

        }

        require 'application/views/_templates/footer.php';

    }

    public function delete_signup($event_id)
    {
        if (!Auth::isLogin()) {
            $this->redirectToHome();
        }

        $events_model = $this->loadModel('EventsModel');

        $joined_teams = $events_model->getUserJoinTeams(Auth::getUserId(), $event_id);

        foreach ($joined_teams as $joined_team) {
            $events_model->deleteTeam($joined_team->id, $event_id);
        }

        $this->redirectToHome();
    }

    public function checkUserId()
    {
        if (!Auth::isLogin()) {
            exit();
        }

        if (isset($_POST["id"])) {
            $obj = new stdClass();
            $register_model = $this->loadModel('RegisterModel');
            $result = $register_model->findAccount($_POST["id"]);
            if (!empty($result)) {
                $obj->valid = "true";
                $obj->name = $result->name;
            } else {
                $obj->valid = "false";
            }
            $JSON = json_encode($obj);
            echo $JSON;
        }
    }

    public function signup($event_id)
    {
        if (!Auth::isLogin())
            $this->redirectToHome();

        $events_model = $this->loadModel('EventsModel');
        $event_info = $events_model->getEvent($event_id);
        $event_teams = $events_model->getAllTeams($event_id);

        if(empty($event_info))
        {
            $this->redirectToHome();
        }

        require 'application/views/_templates/header.php';
        require 'application/views/events/signup.php';
        require 'application/views/_templates/footer.php';
    }

    public function get_team_info()
    {
        if (!Auth::isLogin()) {
            $this->redirectToHome();
        }
        if (isset($_POST["json"])) {
            $events_model = $this->loadModel('EventsModel');
            $obj = json_decode($_POST["json"], false);
            $team_list = $events_model->getUserJoinTeams(Auth::getUserId(), $obj->event_id);
            $resp_obj = new stdClass();
            $resp_obj->team_members = array();
            if (Auth::isAdmin()) {
                $resp_obj->team_name = "New Team";
            } else if (empty($team_list)) {
                $resp_obj->team_name = "New Team";
                $resp_obj->signed_up = FALSE;
                array_push($resp_obj->team_members, array("id" => Auth::getUserId(), "name" => Auth::getUserName()));
            } else {
                $team = $team_list[0];
                $resp_obj->team_name = $team->name;
                $resp_obj->signed_up = TRUE;
                $members = $events_model->getAllTeamMembers($team->id);
                foreach ($members as $member) {
                    array_push($resp_obj->team_members, array("id" => $member->id, "name" => $member->name));
                }
            }
            $resp_obj->myself = Auth::getUserId();
            $JSON_resp = json_encode($resp_obj);
            echo $JSON_resp;
        }

    }

    public function signup_team()
    {
        if (!Auth::isLogin()) {
            $this->redirectToHome();
        }
        if (isset($_POST["json"])) {
            $events_model = $this->loadModel('EventsModel');
            $obj = json_decode($_POST["json"], false);
            if (!Auth::isAdmin() && !in_array(Auth::getUserId(), $obj->team_members)) {
                echo submit_resp::invalid("You must include yourself as team member.");
                exit();
            }
            if (count($obj->team_members) == 0) {
                echo submit_resp::invalid("A team must have at least 1 member.");
                exit();
            }
            if (!Auth::isAdmin()) {
                $team_list = $events_model->getUserJoinTeams(Auth::getUserId(), $obj->event_id);

                if (empty($team_list))
                {
                    $team_id = -1;
                }
                else
                {
                    $team = $team_list[0];
                    $team_id = $team->id;
                }

                $event_info = $events_model->getEvent($obj->event_id);
                $event_teams = $events_model->getAllTeams($obj->event_id);

                if($team_id==-1 && count($event_teams)>=$event_info->team_limit)
                {
                    echo submit_resp::invalid("Sorry, the number of signed up teams already reach maximum.");
                    exit();
                }

                foreach ($obj->team_members as $member_id) {
                    $member_team_list = $events_model->getUserJoinTeams($member_id, $obj->event_id);
                    foreach ($member_team_list as $member_team) {
                        if ($member_team->id != $team_id) {
                            echo submit_resp::invalid($member_id . " has already joined another team.");
                            exit();
                        }
                    }
                }

                foreach ($obj->team_members as $member_id)
                {
                    $events_model->sendEmailTo($member_id,
                        "Hi " . $member_id . ", you now join in new team!",
                        "Welcome " . $member_id . ", <br> Have a great play!");
                }


                if ($team_id != -1) {
                    $events_model->deleteTeam($team_id, $obj->event_id);
                }
            }

            $events_model->addTeam($obj->team_name, $obj->event_id, $obj->team_members);
            echo submit_resp::valid("");
        }
    }

    public function leave_team()
    {
        if (!Auth::isLogin()) {
            $this->redirectToHome();
        }
        if (isset($_POST["json"])) {
            $events_model = $this->loadModel('EventsModel');
            $obj = json_decode($_POST["json"], false);

            if (true) {
                $team_list = $events_model->getUserJoinTeams(Auth::getUserId(), $obj->event_id);
                $team_id;
                if (empty($team_list)) {
                    $team_id = -1;
                } else {
                    $team = $team_list[0];
                    $team_id = $team->id;
                }
                $members = $events_model->getAllTeamMembers($team_id);
                if (count($members) <= 1) {
                    echo submit_resp::invalid("A team must have at least 1 member.");
                    exit();
                }
                $me = Auth::getUserId();
                $team_members = [];
                foreach ($members as $member) {
                    $member_id = $member->id;
                    if ($member_id !== $me) {
                        array_push($team_members, $member_id);
                    }
                }
                if ($team_id != -1) {
                    $events_model->deleteTeam($team_id, $obj->event_id);
                } else {
                    echo submit_resp::invalid("Cannot leave the team because the team does not exist");
                    exit();
                }
            }

            $events_model->addTeam($team->name, $obj->event_id, $team_members);
            echo submit_resp::valid("");
        }
    }

    public function admin_delete_signup($event_id,$team_id)
    {
        if (!Auth::isAdmin())
        {
            $this->redirectToHome();
        }
        $events_model = $this->loadModel('EventsModel');
        $events_model->deleteTeam($team_id, $event_id);
        header('location: ' . URL . 'events/status');
        exit();
    }
}
