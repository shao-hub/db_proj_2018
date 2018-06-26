document.getElementById("user_id").addEventListener("change",check_id);
document.getElementById("submit_signup_account").disabled=true;
var id_available = false;

function check_id()
{

    var input_id=document.getElementById("user_id");
    var submit=document.getElementById("submit_signup_account");

    if(input_id.value !== null)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
                id_available=false;
                var Resp = JSON.parse(this.responseText);
                if(Resp.valid==="true")
                {
                    document.getElementById("user_id_msg").textContent = "學號正確";
                    id_available=true;
                }
                else if (Resp.valid==="invalid")
                {
                    document.getElementById("user_id_msg").textContent = "學號必須是 7 位數字";
                }
                else
                    document.getElementById("user_id_msg").textContent = "此學號的人已註冊帳號";
                submit.disabled = !registrationOK();
            }
        };
        xmlhttp.open("POST", Globals.URL+"register/checkUserId", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+encodeURIComponent(input_id.value));
    }
}
