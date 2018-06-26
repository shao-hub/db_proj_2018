<section>
    <h1>登入</h1>
    <!-- main content output -->
    <div>
        <form action="<?php echo URL; ?>login/loginAccount" method="POST">
            <label>ID</label>
            <input type="text" name="user_id" value="" required><br>
            <lable>Password</lable>
            <input type="password" name="user_pw" value="" required><br>
            <input type="submit" name="submit_login_account" value="登入" />
        </form>
    </div>
    <p>沒有帳號？請<a href="<?= URL ?>register">註冊</a></p>
</section>
