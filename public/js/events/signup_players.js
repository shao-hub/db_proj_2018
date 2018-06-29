document.getElementById("add_new_player").addEventListener("click",add_player);
document.getElementById("submit_team").addEventListener("click",submit_team);
document.getElementById("team_name").addEventListener("input",preventLeave);
var table_container=document.getElementById("player_list");
var new_player_id=document.getElementById("new_player_id")
var error_msg=document.getElementById("error_msg")
var signed_up_msg=document.getElementById("signed_up_msg")
var max_team_member=parseInt(document.getElementById("max_team_member").value);
var min_team_member=1;
var player_list=
    {
        player_arr:[],
        addPLayer:
        function (new_player)
        {
            preventLeave();
            this.player_arr.push(new_player);
            this.draw_all_players();
        },
        checkPlayerExist:
        function (player_id)
        {
            for(var i=0;i<this.player_arr.length;i++)
            {
                if(this.player_arr[i].id===player_id)
                {
                    return true;
                }
            }
            return false;
        },
        draw_all_players:
        function ()
        {
            var player_table = document.createElement("TABLE");
            var header=player_table.createTHead();
            var header_row=header.insertRow();
            header_row.insertCell().textContent="學號";
            header_row.insertCell().textContent="姓名";
            header_row.insertCell().textContent="刪除";

            for(var i=0;i<this.player_arr.length;i++)
            {
                var new_row=player_table.insertRow();
                new_row.insertCell().textContent=this.player_arr[i].id;
                new_row.insertCell().textContent=this.player_arr[i].name;
                var delete_button=document.createElement("button");
                delete_button.className = "red button"
                if (this.player_arr[i].id === this.myself)
                    delete_button.textContent="退出隊伍"
                else
                    delete_button.textContent="刪除組員"
                delete_button.addEventListener("click", player_list.delPlayer.bind(player_list,i));
                new_row.insertCell().appendChild(delete_button);
            }
            while(table_container.firstChild)
                table_container.removeChild(table_container.firstChild);
            table_container.appendChild(player_table);
            document.getElementById("add_new_player").disabled = (this.countPlayer()>=max_team_member);
        },
        delPlayer:
        function(i)
        {
            if (this.countPlayer() <= min_team_member) {
                alert("隊伍至少要有 "+min_team_member+" 個人");
                return;
            }
            if (this.player_arr[i].id === this.myself) {
                var selfleave = confirm("如果你離開這個隊伍，要回到目前的隊伍就必須由別人將你加入。你確定嗎？");
                if (selfleave) {
                    leave_team();
                }
                return;
            }
            preventLeave();
            this.player_arr.splice(i,1);
            document.getElementById("add_new_player").disable=false;
            this.draw_all_players();
        },
        countPlayer:
        function ()
        {
            return  this.player_arr.length;
        }

    }

get_team_info();

function add_player()
{
    if(new_player_id.value !== null)
    {

        if (player_list.countPlayer()>=max_team_member) {
            error_msg.textContent="隊員太多了";
            return;
        }
        if(player_list.checkPlayerExist(new_player_id.value))
        {
            error_msg.textContent="此人已在報名表上";
            return;
        }


        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
                var Resp = JSON.parse(this.responseText);
                if(Resp.valid==="true")
                {
                    var obj={id:new_player_id.value, name:Resp.name};
                    player_list.addPLayer(obj);
                }
                else
                {
                    error_msg.textContent="用戶不存在";
                }

            }
        };
        xmlhttp.open("POST", Globals.URL+"events/checkUserId", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+encodeURIComponent(new_player_id.value));
    }

}

function submit_team()
{
    if (!confirm("你確定要報名嗎？")) return;
    var obj=
        {
            event_id:document.getElementById("event_id").value,
            team_name:document.getElementById("team_name").value,
            team_members:[]
        };
    for(var i=0;i<player_list.player_arr.length;i++)
    {
        obj.team_members.push(player_list.player_arr[i].id);
    }
    var str=encodeURIComponent(JSON.stringify(obj));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", Globals.URL+"events/signup_team", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var Resp = JSON.parse(this.responseText);
            if(Resp.valid==="true")
            {
                alert("Success");
                canNowLeave();
                window.location.href = Globals.URL+"events";
            }
            else
            {
                error_msg.textContent=Resp.msg;
            }

        }
    };
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("json="+str);
}

function get_team_info()
{
    var obj=
        {
            event_id:document.getElementById("event_id").value,
        };
    var str=encodeURIComponent(JSON.stringify(obj));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", Globals.URL+"events/get_team_info", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var Resp = JSON.parse(this.responseText);
            document.getElementById("team_name").value=Resp.team_name;
            for(var i=0;i<Resp.team_members.length;i++)
            {
                player_list.player_arr.push({id:Resp.team_members[i].id, name:Resp.team_members[i].name});
            }
            player_list.myself = Resp.myself;
            player_list.draw_all_players();
            if (Resp.signed_up === true) signed_up_msg.innerHTML = "你已經報名此活動";
            if (Resp.signed_up === false) signed_up_msg.innerHTML = "你尚未報名";
        }
    };
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("json="+str);
}

function leave_team()
{
    var obj=
        {
            event_id:document.getElementById("event_id").value,
            team_name:document.getElementById("team_name").value
        };
    var str=encodeURIComponent(JSON.stringify(obj));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", Globals.URL+"events/leave_team", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var Resp = JSON.parse(this.responseText);
            if(Resp.valid==="true")
            {
                alert("成功");
                canNowLeave();
                window.location.href = Globals.URL+"events";
            }
            else
            {
                error_msg.textContent=Resp.msg;
            }

        }
    };
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("json="+str);
}
