<?php 
  include_once 'connect.php';
?><!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf8">
  <link rel="stylesheet" href="css/simple.css">
  <title>NCTU Sports</title>
  <!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
  <![endif]-->
</head>
<body>
<?php include ($path."/navbar.php"); ?>
<div class='content'>
<section>
  <h1>最新公告</h1>
  <hr>
  <table>
  <?php
  $rs = $conn->query("SELECT * FROM foo");
  while($row = $rs->fetch()) {
    $title = $row->title;
    $date = date("Y / m / d", $row->date);
    echo '<tr>';
    echo '<td>' . $date . '</td>';
    echo '<td>' . $title . '</td>';
    echo '</tr>';
  } ?>
  </table>
</section>
</div>
</body>
</html>
