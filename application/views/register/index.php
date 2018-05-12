<div class="container">
    <h2>You are in the View: application/views/register/index.php (everything in this box comes from that file)</h2>
    <!-- main content output -->
    <div>
        <form action="<?php echo URL; ?>register/signup" method="POST">
            <label>ID</label>
            <input type="text" name="user_id" value="" required><br>
            <label>Name</label>
            <input type="text" name="user_name" value="" required><br>
            <lable>Password</lable>
            <input type="password" name="user_pw" value="" required><br>
            <input type="submit" name="submit_signup_account" value="Submit" />
            <input type="reset">
        </form>
    </div>
</div>
