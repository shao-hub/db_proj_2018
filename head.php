<?php
// this template needs parameter:
// $title : title of the web page, will append "NCTU sports" at end
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf8">
  <link rel="stylesheet" href="<?=$siteRoot?>/css/simple.css">
  <title><?= isset($GLOBALS['title']) ? $title." - " : "" ; ?>NCTU Sports</title>
  <!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
  <![endif]-->
</head>
<body>
