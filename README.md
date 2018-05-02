# dbfinal


## 給組員

+ `some.php`

  裡面有連接 SQL 用的變數
  
  * `$SQLusername`：連接到 SQL 的帳號
  * `$SQLpassword`：連接到 SQL 的密碼
  
  使用方法：在需要資料庫的 PHP 開頭加上
  ```
  <?php
    include_once 'some.php';
  ?>
  ```
  不要用任何方法輸出這些變數，否則資料庫被駭都要怪你們！

+ `index.php`

  我們網站的門面
