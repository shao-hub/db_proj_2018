<section>
    <h1>最新公告</h1>
    <!-- main content output -->
    <div>
        <?php
        if(Auth::isAdmin())
        {
            ?>
            <a style="float:right;" class="button blue" href="<?php echo URL . 'anncs/add' ; ?>">新增公告</a><br>
        <?php
        }
        ?>

        <table>
            <thead class="cyan-bg">
            <tr>
                <td class="date">日期</td>
                <td>標題</td>
                <?php if (Auth::isAdmin()) { ?><td width="30"></td><?php } ?> 
            </tr>
            </thead>
            <tbody>
            <?php foreach ($anncs as $annc) { ?>
                <tr>
                    <td class="date"><?php
                        if (isset($annc->date))
                            echo $annc->date;
                    ?></td>
                    <td>
                        <a class="cyan-text no-underline" href="<?php echo URL . 'anncs/getDetail/' . $annc->id; ?>"><?php if (isset($annc->title)) echo htmlspecialchars($annc->title); ?></a>
                    </td>
                    <?php
                        if(Auth::isAdmin())
                        {
                            ?>
                            <td><a class="button red delete_confirm" href="<?php echo URL . 'anncs/delete/' . $annc->id; ?>">x</a></td>
                    <?php
                        }
                    ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</section>
