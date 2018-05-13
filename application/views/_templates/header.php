<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Datebase Project 2018</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
    <!-- jQuery
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    -->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- header -->
<div class="container">
    <nav class="navigation cyan-bg">
        <span id="banner">NCTU Sports</span>
        <span class="split"></span>
        <ul class="menu">
            <!-- same like "home" or "home/index" -->
            <li><a href="<?php echo URL; ?>">首頁</a></li>
            <li><a href="<?php echo URL; ?>events">活動報名</a></li>
            <?php
                if(Auth::isLogin())
                {
                    ?>
            <?php
            if(Auth::isAdmin())
            {
                ?>
            <li><a href="<?php echo URL; ?>events/status">報名狀況</a></li>
                <?php
            }
                ?>

            <li><?php echo Auth::getUserName() ?></li>
            <li><a href="<?php echo URL; ?>login/logoutAccount">登出</a></li>
                    <?php
                }
                else
                {
                    ?>

            <li><a href="<?php echo URL; ?>register">註冊</a></li>
            <li><a href="<?php echo URL; ?>login">登入</a></li>

                    <?php
                }
                ?>

            <!-- "songs" and "songs/index" are the same -->
        </ul>
        <span class="split-right"></span>
    </nav>
    <!-- simple div for javascript output, just to show how to integrate js into this MVC construct -->
    <!--
    <h3>Demo JavaScript</h3>
    <div id="javascript-header-demo-box">
    </div>
    -->
</div>
