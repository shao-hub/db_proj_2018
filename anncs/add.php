<?php
include_once '../connect.php';
$post = isset($_POST['title']) && isset($_POST['description']);
$yes = "";
function addAnnouncement($conn) {
  if ($_POST['title'] != '' && $_POST['description'] != '') {
    // rate limiter, will be removed after we implement authentication
    // TODO implement authentication
    $sql = "SELECT id FROM announcement
      WHERE date > DATE_SUB(NOW(), INTERVAL 1 MINUTE)
      LIMIT 1";
    $q = $conn->query($sql);
    if ($q->fetch()) {
      return "too_fast";
    }
    // actually insert data
    $sql = "INSERT INTO announcement(title, description)
      VALUES (:title, :description)";
    $q = $conn->prepare($sql);
    $q->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
    $q->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    return $q->execute() ? "success" : "fail";
  }
  return "invalid_data";
}
if ($post) $yes = addAnnouncement($conn);
?><!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf8">
  <link rel="stylesheet" href="/css/simple.css">
  <title>新增公告 - NCTU Sports</title>
  <!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
  <![endif]-->
</head>
<body>
<?php include ($path."/navbar.php"); ?>
<div class='content'>
<section>
  <h1>新增公告</h1>
  <?php
  if ($post) {
    switch ($yes) {
    case 'invalid_data':
      echo "  <p>發佈失敗，因為沒有標題和內容</p>";
      break;
    case 'too_fast':
      echo "  <p>發布速度太快，伺服器無法負荷</p>";
      break;
    case 'success':
      echo "  <p>成功發佈</p>";
      break;
    case 'fail':
    default:
      echo "  <p>發佈失敗，可能是資料庫出錯了</p>";
      break;
    }
  }
  ?>
  <form action="" method="post">
    <p>
      <label for="title">標題</label><br>
      <input type="text" name="title" size="50" id="title"/>
    </p>
    <p>
      <label for="description">內容</label><br>
      <textarea name="description" rows="8" cols="50" style="width:100%;"
        id="description"></textarea>
    </p>
    <p style="text-align:right;">
      <button type="submit">發佈</button>
      <button type="reset" onclick="history.go(-1)">取消</button>
    </p>
  </form>
</section>
</div>
</body>
</html>
