var submit=document.getElementById("submit_signup_account")
submit.disabled=true;

document.getElementById("user_pw").addEventListener("change",compPassword);
document.getElementById("user_pw_conf").addEventListener("change",compPassword);

function compPassword()
{
    var pw1=document.getElementById("user_pw");
    var pw2=document.getElementById("user_pw_conf");
    var pw_msg=document.getElementById("user_pw_msg");
    if(pw1.textContent!=null
        &&pw2.textContent!=null)
    {
        if(pw1.value===pw2.value)
        {
            pw_msg.textContent="Passwords match";
            submit.disabled=false;
            return;
        }
        else
        {
            pw_msg.textContent="Passwords do not match";
        }
    }
    else
    {
        pw_msg.textContent=null;
    }
    submit.disabled=true;
}


