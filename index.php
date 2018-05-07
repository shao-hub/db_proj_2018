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
  <table><?php
  if (isset($_GET['page'])) $page = $_GET['page'];
  else $page = 1;
  $page = intval($page, 10);
  if ($page < 1) $page = 1;
  $sql = "SELECT * FROM announcement ORDER BY date DESC LIMIT :page, 10";
  $q = $conn->prepare($sql);
  $recno = ($page - 1) * 10;
  $q->bindParam(':page', $recno, PDO::PARAM_INT);
  $q->execute();
  $has = false;
  while($row = $q->fetch()) {
    $title = $row['title'];
    $date = strtotime($row['date']);
    $date = date("Y / m / d", $date);
    $id = $row['id'];
    $has = true;
  ?> 
  <tr>
    <td class="date"><?= $date ?></td>
    <td>
      <a class="cyan-text no-underline" href="anncs.php?id=<?= $id ?>"><?= $title ?></a>
    </td>
  </tr><?php } ?> 
  </table>
  <?php if (!$has) {
    if ($page == 1) { ?><p>目前沒有公告！</p><?php }
    else { ?><p>到底了！</p><?php }
  } ?> 
</section>
</div>
</body>
</html>
