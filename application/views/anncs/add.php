<div class="container">
    <h2>You are in the View: application/views/anncs/add.php (everything in this box comes from that file)</h2>
    <!-- main content output -->
    <div>
        <form action="<?php echo URL; ?>anncs/add" id="add_anncs_form" method="POST">
            <label>Title</label>
            <input type="text" name="title" value="" required><br>
            <label>Date</label>
            <input type="date" name="date" value="<?php echo date("Y-m-d"); ?>" required><br>
            <input type="submit" name="submit_add_anncs" value="Submit" />
            <input type="reset">
        </form>

        <textarea name="description" form="add_anncs_form"></textarea>

    </div>
</div>
