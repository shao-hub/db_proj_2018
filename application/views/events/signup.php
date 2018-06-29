<script src="<?php echo URL; ?>public/js/preventleave.js"></script>
<section>

<h1>活動報名</h1>

  <div style="border-radius: 5px; background-color: lightgray; padding: 5px 30px;">
    <?php
        echo '<h3>'.$event_info->name.'</h3>';
        echo '<p>報名隊伍數：'.count($event_teams).'/'.$event_info->team_limit.'</h4>';
        echo '<p>人數限制：'.$event_info->team_size_limit.'</p>';
    ?>
    <p id="signed_up_msg"></p>
    <?php if ($event_info->description) { ?>
    <p>規則：</p>
    <blockquote><?= $event_info->description; ?></blockquote>
    <?php } ?>
  </div>

 <form onsubmit="submit_team(); return false;">
     <p>
     <label>隊伍名稱</label>
     <input type="text" id="team_name" name="name" value="" required>
     </p>
     <input type="hidden" id="max_team_member" value="<?php echo $event_info->team_size_limit; ?>">
     <input type="hidden" id="event_id" value="<?php echo $event_info->id; ?>">
 </form>

 <div id="player_list"></div>

 <script src="<?php echo URL.'public/js/events/signup_players.js'; ?>"  defer></script>

 <form onsubmit="add_player(); return false;">
     <label>ID</label>
     <input type="text" id="new_player_id" name="id" value="" required>
 </form>
     <button class="blue button" id="add_new_player">新增隊員</button><br>
     <span id="error_msg"></span><br>
     <button class="blue button" type="button" id="submit_team">提交報名表</button>
     <button class="red button delete_confirm" href="<?php echo URL.'events/delete_signup/'.$event_info->id;?>">刪除報名表</button>
</section>
