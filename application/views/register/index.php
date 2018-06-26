<section>
    <h1>註冊</h1>
    <!-- main content output -->
    <div>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="<?php echo URL; ?>public/js/register/password_confirm.js"  defer></script>
        <script src="<?php echo URL; ?>public/js/register/check_user_id.js"  defer></script>
        <form action="<?php echo URL; ?>register/signup" method="POST">
            <p>
            <label>ID</label>
            <input class="wide" type="text" id="user_id" name="user_id" value="" required><br>
            <span id="user_id_msg"></span>
            </p>
            <p>
            <label>Name</label>
            <input class="wide" type="text" name="user_name" value="" required>
            </p>
            <p>
            <label>E-mail</label>
            <input class="wide" type="email" name="user_email" value="" required>
            </p>
            <p>
            <label>Password</label>
            <input class="wide" type="password" id="user_pw" name="user_pw" value="" required>
            </p>
            <p>
            <label>Confirm Password</label>
            <input class="wide" type="password" id="user_pw_conf" name="user_pw_conf" value="" required><br>
            <span id="user_pw_msg"></span>
            </p>
            <p><div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITEKEY?>"></div><br></p>
            <p>
              <button type="submit" id="submit_signup_account"
                name="submit_signup_account" class="button cyan"
                onclick="return registerCheck()">註冊</button>
              <button class="button red" onclick='location.href="<?php echo URL; ?>";'>取消</button>
            </p>
        </form>
    </div>
</section>
