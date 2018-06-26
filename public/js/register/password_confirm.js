var submit=document.getElementById("submit_signup_account")
var passwordMatch = false;

document.getElementById("user_pw").addEventListener("change",compPassword);
document.getElementById("user_pw_conf").addEventListener("change",compPassword);

function compPassword()
{
    var pw1=document.getElementById("user_pw");
    var pw2=document.getElementById("user_pw_conf");
    var pw_msg=document.getElementById("user_pw_msg");
    password_match = false;
    if(pw1.value!==""
        &&pw2.value!=="")
    {
        if(pw1.value===pw2.value)
        {
            pw_msg.textContent="兩次密碼相同";
            password_match = true;
        }
        else
        {
            pw_msg.textContent="兩次密碼不相同";
        }
    }
    else
    {
        pw_msg.textContent=null;
    }
    submit.disabled = !registrationOK();
}

function registrationOK() {
    return password_match && id_available;
}
