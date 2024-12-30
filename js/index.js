async function resetText(inputId){      
    const inputField = document.getElementById(inputId);
    
    if (inputField) {
        inputField.value = "";
    } else {
        console.error("Input field not found!");
    }
}

document.addEventListener("click", function(event) { 
    console.log(event);   
    if(event.target.closest("li.user_icon a")){
        console.log("OK");
        document.getElementById("submenu_user").style.display = "initial";
    }
    else{
        document.getElementById("submenu_user").style.display = "none";
    }
});