<section>
    <h1>新增活動</h1>
    <!-- main content output -->
    <div>
        <form action="<?php echo URL; ?>events/add" id="add_event_form" method="POST">
            <p>
                <label for="name">Title</label><br>
                <input type="text" id="name" name="name" value="" required>
            </p>
            <p>
                <label for="date">Date</label><br>
                <input type="date" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" required>
            </p>
            <p>
                <label for="team_limit">Team Limit</label><br>
                <input type="number" id="team_limit" name="team_limit" min="1">
            </p>
            <p>
                <label for="team_size_limit">Team Size Limit</label><br>
                <input type="number" id="team_size_limit" name="team_size_limit" min="1">
            </p>
            <input type="submit" name="submit_add_event" value="Submit" />
            <button onclick='location.href="<?php echo URL; ?>events";'>Cancel</button>
        </form>
    </div>
</section>
