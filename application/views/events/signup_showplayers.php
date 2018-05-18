<?php
/**
 * Created by PhpStorm.
 * User: syhaung
 * Date: 5/18/18
 * Time: 9:29 AM
 */
foreach ($_SESSION['signup']['player_added'] as $id => $name)
{
    echo '<p>'.$id.'&nbsp;'.$name.'</p>';
}
if(isset($err_msg))
{
    echo '<p>'.$err_msg.'</p>';
}
