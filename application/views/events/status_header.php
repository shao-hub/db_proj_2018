<section>
    <h1>報名狀況</h1>
    <!-- main content output -->
    <div>
        <?php
        if (isset($event->name))
            echo '<h2>'.htmlspecialchars($event->name).'</h2>';
        ?>
        <?php if (count($teams) == 0) { ?>
            <p>尚無人報名</p>
        <?php } else { ?>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>隊伍名稱</td>
                <td>隊伍成員</td>
                <td>刪除隊伍</td>
            </tr>
            </thead>
            <tbody>
        <?php } ?>
