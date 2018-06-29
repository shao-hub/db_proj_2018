
<tr>
    <td>
    <?php
    if (isset($team->name))
        echo htmlspecialchars($team->name);
    ?>
    </td>
    <td>
                <?php
                foreach ($members as $member)
                {
                    if (isset($member->id)) echo htmlspecialchars($member->id).'&ensp;';
                    if (isset($member->name)) echo htmlspecialchars($member->name).'<br>';
                }
                if (count($members) == 0) {
                    echo '無成員';
                }
                ?>
    </td>
    <td>
    <?php
    if (Auth::isAdmin()) {
        ?>
        <a style="float:left;" class="button red delete_confirm"
           href="<?php echo URL . 'events/admin_delete_signup/' . $event->id . '/' . $team->id; ?>"
           class="delete_confirm">刪除</a>
        <?php
    }
    ?>
    </td>
</tr>
