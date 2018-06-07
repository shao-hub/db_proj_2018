

 <form>
     <label>Team Name</label>
     <input type="text" id="team_name" name="name" value="" required><br>
     <input type="hidden" id="max_team_member" value="<?php echo $event_info->team_size_limit; ?>">
     <input type="hidden" id="event_id" value="<?php echo $event_info->id; ?>">
 </form>

 <div id="player_list"></div>

 <script src="<?php echo URL.'public/js/events/signup_players.js'; ?>"  defer></script>

 <form>
     <label>ID</label>
     <input type="text" id="new_player_id" name="id" value="" required>
 </form>
 <span id="error_msg"></span><br>
 <button id="add_new_player">Add New Player</button><br>
 <button id="submit_team">Submit Team</button><br>
