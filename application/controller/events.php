<?php


class Events extends Controller
{

    public function index()
    {
        // simple message to show where you are
        echo 'Message from Controller: You are in the Controller: Events, using the method index().';

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



    public function add()
    {
        // simple message to show where you are
        echo 'Message from Controller: You are in the Controller: events, using the method add().';

        if(!Auth::isAdmin())
        {
            header('location: ' . URL . 'events/index');
            return;
        }

        // if we have POST data to create a new song entry
        if (isset($_POST["submit_add_event"])) {
            // load model, perform an action on the model
            $events_model=$this->loadModel('EventsModel');
            $events_model->addEvent($_POST["name"], $_POST["date"],  $_POST["team_limit"],$_POST["team_size_limit"]);
            header('location: ' . URL . 'events/index');
            return;
        }

        require 'application/views/_templates/header.php';
        require 'application/views/events/add.php';
        require 'application/views/_templates/footer.php';
    }


    public function edit($event_id)
    {
        // simple message to show where you are
        echo 'Message from Controller: You are in the Controller: events, using the method add().';

        if(!Auth::isAdmin())
        {
            header('location: ' . URL . 'events/index');
            return;
        }

        // if we have POST data to create a new song entry
        if (isset($_POST["submit_edit_event"])) {
            // load model, perform an action on the model
            $events_model=$this->loadModel('EventsModel');
            $events_model->editEvent($event_id,$_POST["name"], $_POST["date"],  $_POST["team_limit"],$_POST["team_size_limit"]);
            header('location: ' . URL . 'events/index');
            return;
        }

        require 'application/views/_templates/header.php';
        require 'application/views/events/edit.php';
        require 'application/views/_templates/footer.php';
    }

    public function delete($event_id)
    {
        echo 'Message from Controller: You are in the Controller: Events, using the method delete().';

        if(!Auth::isAdmin())
        {
            header('location: ' . URL . 'events/index');
            return;
        }


        if (Auth::isAdmin()&&isset($event_id))
        {
            $anncs_model=$this->loadModel('EventsModel');
            $anncs_model->deleteEvent($event_id);
        }

        header('location: ' . URL . 'events/index');
    }

    public function status()
    {
        echo 'Message from Controller: You are in the Controller: Anncs, using the method delete().';

        if(!Auth::isAdmin())
        {
            header('location: ' . URL . 'events/index');
            return;
        }

        require 'application/views/_templates/header.php';

        $events_model = $this->loadModel('EventsModel');
        $events = $events_model->getAllEvents();

        foreach($events as $event)
        {
            echo<<<_END
            <div class="container">
            <h2>You are in the View: application/views/events/status.php (everything in this box comes from that file)</h2>
            <!-- main content output -->
            <div>
                
_END;
            if (isset($event->name))
            echo '<h2>'.$event->name.'</h2>';
            echo<<<_END
                    <table>
                        <thead style="background-color: #ddd; font-weight: bold;">
                        <tr>
                            <td>Team Name</td>
                            <td>Team Members</td>
                        </tr>
                        </thead>
                        <tbody>
_END;

            $teams=$events_model->getAllTeams($event->id);
            foreach($teams as $team)
            {
                echo "<tr>";
                if (isset($team->name))
                    echo '<td>'.$team->name.'</td>';

                $members=$events_model->getAllTeamMembers($team->id);

                require 'application/views/events/status_member.php';

                echo '</tr>';

            }
            echo<<<_END
                        </tbody>
                </table>
            </div>
        </div>
_END;

        }

        require 'application/views/_templates/footer.php';

    }

    public function signup($event_id)
    {
        // simple message to show where you are
        echo 'Message from Controller: You are in the Controller: Anncs, using the method getDetail().';

        require 'application/views/_templates/header.php';
        require 'application/views/events/signup.php';
        require 'application/views/_templates/footer.php';
    }
}
