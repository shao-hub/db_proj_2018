<section>
    <h1>新增活動</h1>
    <!-- main content output -->
    <div>
        <form action="<?php echo URL; ?>events/add" id="add_event_form" method="POST">
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
            <p>
                <label for="description">規則</label>
                <textarea class="wide" name="description" id="description"></textarea></p>
            <p>
            <p>
            <input class="button cyan" type="submit" name="submit_add_event" value="發佈" />
            <button class="button red" onclick='location.href="<?php echo URL; ?>events";'>取消</button>
            </p>
        </form>
    </div>
</section>
