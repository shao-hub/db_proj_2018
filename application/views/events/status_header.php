<section>
    <h1>報名狀況</h1>
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
