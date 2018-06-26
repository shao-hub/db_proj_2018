<script src="<?php echo URL; ?>public/js/preventleave.js"></script>
<section>
<h1>活動報名</h1>
 <form>
     <label>Team Name</label>
     <input type="text" id="team_name" name="name" value="" required><br>
     <input type="hidden" id="max_team_member" value="<?php echo $event_info->team_size_limit; ?>">
     <input type="hidden" id="event_id" value="<?php echo $event_info->id; ?>">
 </form>

 <div id="player_list"></div>

 <script src="<?php echo URL.'public/js/events/signup_players.js'; ?>"  defer></script>

 <form onsubmit="add_player(); return false;">
     <label>ID</label>
     <input type="text" id="new_player_id" name="id" value="" required>
 </form>
     <button id="add_new_player">新增隊員</button><br>
     <span id="error_msg"></span><br>
     <button type="button" id="submit_team">提交報名表</button>
     <button class="delete_confirm" href="<?php echo URL.'events/delete_signup/'.$event_info->id;?>">刪除報名表</button>
</section>
