<?php

class Problem extends Controller
{
    public function index()
    {
        $response_code = http_response_code();
        if ($response_code == 200) {
            $response_code = 404;
            http_response_code($response_code);
        }
        require 'application/views/_templates/header.php';
        $file = 'application/views/problem/' . $response_code . '.php';
        if (file_exists($file)) {
            require $file;
        }
        else {
            echo "<div class=\"content\"><section>\n";
            echo "    <h1>發生 $response_code 錯誤</h1>\n";
            echo "    <p>請向 <a href=\"https://github.com/stdio2016\">stdio2016</a> 回報網站問題</p>";
            echo "</section></div>";
        }
        require 'application/views/_templates/footer.php';
    }

}
