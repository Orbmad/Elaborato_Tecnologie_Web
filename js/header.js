function open_submenu(){
    document.getElementById("submenu_user").style.display = "initial";
}

function close_submenu(){
    document.getElementById("submenu_user").style.display = "none";
    console.log(document.getElementById("submenu_user"));
}

function checkVisibilityOfNotificationCircle(isUserLogged){
    if(!isUserLogged){
        document.querySelector("header ul li.user_icon a img:nth-child(2)").style.visibility = 'hidden';
        document.querySelector("header ul li.user_icon a p").style.display = 'none';
    } else{
        document.querySelector("header ul li.user_icon img:nth-child(2)").style.display = 'initial';
        document.querySelector("header ul li.user_icon a p").style.display = 'initial';
    }
}