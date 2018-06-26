function preventLeave() {
    onbeforeunload = function() {
        return "你確定要離開嗎？你填寫的資料將會遺失";
    };
}

function canNowLeave() {
    onbeforeunload = null;
}
