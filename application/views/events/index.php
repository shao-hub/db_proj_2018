<section>
    <h1>活動列表</h1>
    <!-- main content output -->
    <?php if (!Auth::isLogin()) { ?><p>報名之前請先<a href="<?=URL?>login">登入</a></p><?php } ?>
    <div>
        <?php
        if(Auth::isAdmin())
        {
            ?>
            <a style="float:right;" class="button blue" href="<?php echo URL . 'events/add' ; ?>">新增活動</a><br>
            <?php
        }
        ?>

        <table>
            <thead class="cyan-bg">
            <tr>
                <td>項目</td>
                <td class="date">日期</td>
                <?php if (Auth::isLogin()) echo '<td style="width:60px;">報名</td>'; ?>
                <?php
                if(Auth::isAdmin())
                {
                    ?><td>管理員操作</td>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($events as $event) { ?>
                <tr>
                    <td><?php if (isset($event->name)) echo htmlspecialchars($event->name); ?></td>
                    <td><?php if (isset($event->date)) echo $event->date; ?></td>
                    <?php if (Auth::isLogin()) echo '<td style="text-align:center;"><a class="button cyan" href="'.URL.'events/signup/' . $event->id . '">報名</a></td>' ; ?>
                    <?php
                    if(Auth::isAdmin())
                    {
                        ?>
                        <td>
                        <a style="float:left;" class="button blue" href="<?php echo URL . 'events/edit/' . $event->id; ?>">修改</a>
                        <a style="float:left;" class="button green" href="<?php echo URL . 'events/status/' . $event->id; ?>">報名狀況</a>
                        <a style="float:left;" class="button red delete_confirm" href="<?php echo URL . 'events/delete/' . $event->id; ?>" class="delete_confirm" >刪除</a>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</section>
