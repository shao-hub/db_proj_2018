<?php
include_once 'some.php';
$dbname = 'nctu_sports';
try {
    $conn = new PDO("mysql:host=$SQLhost;port=$SQLport;dbname=$dbname",
        $SQLusername, $SQLpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "連線失敗: " . $e->getMessage();
}
?>
