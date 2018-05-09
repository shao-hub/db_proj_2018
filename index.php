<?php 
  include_once 'connect.php';
?>
<?php include ($path."/head.php"); ?>
<?php include ($path."/navbar.php"); ?>
<div class='content'>
<section>
  <h1>最新公告</h1>
  <table><?php
  if (isset($_GET['page'])) $page = $_GET['page'];
  else $page = 1;
  $page = intval($page, 10);
  if ($page < 1 || $page > 214748364) $page = 1;
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
      <a class="cyan-text no-underline" href="anncs?id=<?= $id ?>"><?= $title ?></a>
    </td>
  </tr><?php } ?> 
  </table>
  <?php if (!$has) {
    if ($page == 1) { ?><p>目前沒有公告！</p><?php }
    else { ?><p>到底了！</p><?php }
  } ?> 
  <div class="text-center"><ul class="change-page">
  <?php
  // calculate total pages
  $sql = "SELECT COUNT(*) As cnt FROM announcement";
  $q = $conn->prepare($sql);
  $q->execute();
  $row = $q->fetch();
  $maxPage = ceil($row['cnt'] / 10);
  // output paginator <<
  if ($page > 1) {
    $prevPage = $page-1;
    echo "    <li><a href=\"?page=$prevPage\">«</a>\n";
  }
  // output paginator 1~10
  $minCanSee = max(min($page, $maxPage - 3) - 3, 1);
  $maxCanSee = min($minCanSee + 6, $maxPage);
  for ($i = $minCanSee; $i <= $maxCanSee; $i++) {
    echo '    <li';
    if ($i == $page) echo ' class="selected"';
    echo "><a href=\"?page=$i\">$i</a>\n";
  }
  // output paginator >>
  if ($page < $maxPage) {
    $nextPage = $page+1;
    echo "    <li><a href=\"?page=$nextPage\">»</a>\n";
  } ?>
  </ul></div>
</section>
</div>
</body>
</html>
