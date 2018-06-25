<section>
    <div>
        <h1>新增公告</h1>
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
</section>
