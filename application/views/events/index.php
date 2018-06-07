<div class="container">
    <h2>You are in the View: application/views/events/index.php (everything in this box comes from that file)</h2>
    <!-- main content output -->
    <div>
        <?php
        if(Auth::isAdmin())
        {
            ?>
            <a href="<?php echo URL . 'events/add' ; ?>">add an event</a><br>
            <?php
        }
        ?>

        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>name</td>
                <td>date</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($events as $event) { ?>
                <tr>
                    <td><?php if (isset($event->name)) echo $event->name; ?></td>
                    <td><?php if (isset($event->date)) echo $event->date; ?></td>
                    <?php if (Auth::isLogin()) echo '<td><a href="'.URL.'events/signup/' . $event->id . '">signup</a></td>' ; ?>
                    <?php if (Auth::isLogin()) echo '<td><a href="'.URL.'events/delete_signup/' . $event->id . '">delete signup</a></td>' ; ?>
                    <?php
                    if(Auth::isAdmin())
                    {
                        ?>
                        <td><a href="<?php echo URL . 'events/edit/' . $event->id; ?>">edit</a></td>
                        <td><a href="<?php echo URL . 'events/status/' . $event->id; ?>">status</a></td>
                        <td><a href="<?php echo URL . 'events/delete/' . $event->id; ?>" class="delete_confirm" >delete</a></td>
                        <?php
                    }
                    ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</div>
