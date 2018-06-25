<section>
    <h1>新增活動</h1>
    <!-- main content output -->
    <div>
        <form action="<?php echo URL; ?>events/add" id="add_event_form" method="POST">
            <label>Title</label>
            <input type="text" name="name" value="" required><br>
            <label>Date</label>
            <input type="date" name="date" value="<?php echo date("Y-m-d"); ?>" required><br>
            <label>Team Limit</label>
            <input type="number" name="team_limit" min="1">
            <label>Team Size Limit</label>
            <input type="number" name="team_size_limit" min="1">
            <input type="submit" name="submit_add_event" value="Submit" />
            <input type="reset">
        </form>
        <button onclick='location.href="<?php echo URL; ?>events";'>Cancel</button>
    </div>
</section>
