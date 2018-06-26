<section>
    <div>
        <h1>新增公告</h1>
        <script src="<?=URL?>public/js/preventleave.js"></script>
        <form onchange="preventLeave()" action="<?php echo URL; ?>anncs/add" id="add_anncs_form" method="POST">
            <p>
                <label>標題</label>
                <input class="wide" type="text" name="title" value="" required>
            </p>
            <p>
                <label>日期</label>
                <input class="wide" type="date" name="date" value="<?php echo date("Y-m-d"); ?>" required>
            </p>
            <p>
                <label>內容</label>
                <textarea class="wide" name="description" form="add_anncs_form"></textarea></p>
            <p>
            <input class="button cyan" type="submit" name="submit_add_anncs" value="發布" onclick="canNowLeave()" />
            <input class="button red" type="button" value="取消" onclick="history.go(-1)">
            </p>
        </form>

    </div>
</section>
