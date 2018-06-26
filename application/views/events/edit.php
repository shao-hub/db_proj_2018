<section>
    <h1>修改活動</h1>
    <!-- main content output -->
    <div>
        <form action="<?php echo URL.'events/edit/'.$event_id; ?>" id="edit_event_form" method="POST">
            <p>
                <label for="name">活動名稱</label><br>
                <input class="wide" type="text" id="name" name="name" value="" required>
            </p>
            <p>
                <label for="date">活動日期</label><br>
                <input class="wide" type="date" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" required>
            </p>
            <p>
                <label for="team_limit">隊伍數限制</label><br>
                <input class="wide" type="number" id="team_limit" name="team_limit" min="1">
            </p>
            <p>
                <label for="team_size_limit">每隊人數上限</label><br>
                <input class="wide" type="number" id="team_size_limit" name="team_size_limit" min="1">
            </p>
            <input class="button cyan" type="submit" name="submit_edit_event" value="儲存" />
            <button class="button red" type="button" onclick='location.href="<?php echo URL; ?>events";'>取消</button>
        </form>
    </div>
</section>
<!-- passing event data from server to client -->
<script>
(function(){
    function seti(i,v){document.getElementById(i).value=v;}
    seti("name",<?=json_encode($event->name)?>);
    seti("date",<?=json_encode($event->date)?>);
    seti("team_limit",<?=json_encode($event->team_limit)?>);
    seti("team_size_limit",<?=json_encode($event->team_size_limit)?>);
})();
</script>
