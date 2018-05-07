<?php 
  include_once '../connect.php';
  if (isset($_GET['id'])) $id = $_GET['id'];
  else $id = 1;
  $id = intval($id, 10);
  if ($id < 1 || $id > 2147483647) $id = 1;
  $sql = "SELECT * FROM announcement WHERE id = :id";
  $q = $conn->prepare($sql);
  $q->bindParam(':id', $id, PDO::PARAM_INT);
  $q->execute();
  if ($row = $q->fetch()) {
    $title = $row['title'];
    $title = htmlspecialchars($title, ENT_NOQUOTES);
    $date = strtotime($row['date']);
    $date = date("Y / m / d H:i", $date);
    $description = $row['description'];
    $description = htmlspecialchars($description, ENT_NOQUOTES);
    $description = str_replace(["\n\n", "\n"], ["</p><p>", "\n"], $description);
  }
  else {
    $title = '找不到公告';
  }
?><!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf8">
  <link rel="stylesheet" href="/css/simple.css">
  <title><?= $title ?> - NCTU Sports</title>
  <!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
  <![endif]-->
</head>
<body>
<?php include ($path."/navbar.php"); ?>
<div class='content'>
<section>
<?php if ($row) { ?>
  <h1><?= $title ?></h1>
  <div class="cyan-text"><?= $date ?></div>
  <div style="margin-left: 10px; white-space: pre-wrap;"><p><?= $description ?></p></div>
<?php } else { ?>
  <h1>找不到公告</h1>
  <p>可能是該公告已被移除，或是網站出了錯誤</p>
<?php } ?>
</section>
</div>
</body>
</html>
