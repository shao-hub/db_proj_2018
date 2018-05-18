<div class="container">
    <h2>You are in the View: application/views/events/status_header.php (everything in this box comes from that file)</h2>
    <!-- main content output -->
    <div>
        <?php
        if (isset($event->name))
            echo '<h2>'.$event->name.'</h2>';
        ?>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Team Name</td>
                <td>Team Members</td>
            </tr>
            </thead>
            <tbody>