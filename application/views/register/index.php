<div class="container">
    <h2>You are in the View: application/views/register/index.php (everything in this box comes from that file)</h2>
    <!-- main content output -->
    <div>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="<?php echo URL; ?>public/js/register/password_confirm.js"  defer></script>
        <script src="<?php echo URL; ?>public/js/register/check_user_id.js"  defer></script>
        <form action="<?php echo URL; ?>register/signup" method="POST">
            <label>ID</label>
            <input type="text" id="user_id" name="user_id" value="" required>
            <span id="user_id_msg"></span><br>
            <label>Name</label>
            <input type="text" name="user_name" value="" required><br>
            <label>E-mail</label>
            <input type="text" name="user_email" value="" required><br>
            <label>Password</label>
            <input type="password" id="user_pw" name="user_pw" value="" required><br>
            <label>Confirm Password</label>
            <input type="password" id="user_pw_conf" name="user_pw_conf" value="" required>
            <span id="user_pw_msg"></span><br>
            <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITEKEY?>"></div><br>
            <input type="submit" id="submit_signup_account" name="submit_signup_account" value="Submit" />
            <input type="reset">
        </form>
        <button onclick='location.href="<?php echo URL; ?>";'>Cancel</button>
    </div>
</div>
