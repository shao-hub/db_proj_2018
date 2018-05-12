<div class="container">
    <h2>You are in the View: application/views/events/add.php (everything in this box comes from that file)</h2>
    <!-- main content output -->
    <div>
        <form action="<?php echo URL.'events/edit/'.$event_id; ?>" id="edit_event_form" method="POST">
            <label>Title</label>
            <input type="text" name="name" value="" required><br>
            <label>Date</label>
            <input type="date" name="date" value="<?php echo date("Y-m-d"); ?>" required><br>
            <label>Team Limit</label>
            <input type="number" name="team_limit" min="1">
            <label>Team Size Limit</label>
            <input type="number" name="team_size_limit" min="1">
            <input type="submit" name="submit_edit_event" value="Submit" />
            <input type="reset">
        </form>
    </div>
</div>
