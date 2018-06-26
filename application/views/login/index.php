<section>
    <h1>登入</h1>
    <!-- main content output -->
    <div>
        <form action="<?php echo URL; ?>login/loginAccount" method="POST">
            <p>
            <label>學號</label>
            <input class="wide" type="text" name="user_id" value="" required>
            </p>
            <p>
            <lable>密碼</lable>
            <input class="wide" type="password" name="user_pw" value="" required><br>
            </p>
            <p>
            <input class="button cyan" type="submit" name="submit_login_account" value="登入" />
            </p>
        </form>
    </div>
    <p>沒有帳號？請<a href="<?= URL ?>register">註冊</a></p>
</section>
