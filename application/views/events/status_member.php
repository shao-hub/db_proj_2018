
<tr>
    <?php
    if (isset($team->name))
        echo '<td>'.htmlspecialchars($team->name).'</td>';
    ?>
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
</tr>
