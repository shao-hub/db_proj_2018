document.getElementById("user_id").addEventListener("change",check_id);
document.getElementById("submit_signup_account").disable=true;

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
                var Resp = JSON.parse(this.responseText);
                if(Resp.valid==="true")
                {
                    document.getElementById("user_id_msg").textContent = "Valid user ID";
                    submit.disable=false;
                    return;
                }
                else
                    document.getElementById("user_id_msg").textContent = "User ID already exists";

                submit.disable=true;
            }
        };
        xmlhttp.open("POST", Globals.URL+"register/checkUserId", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+encodeURIComponent(input_id.value));
    }
    submit.disable=true;
}
