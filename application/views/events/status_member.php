
                    <td>
                <?php
                foreach ($members as $member)
                {
                    if (isset($member->id)) echo $member->id.'&ensp;';
                    if (isset($member->name)) echo $member->name.'<br>';
                }
                ?>
                    </td>

