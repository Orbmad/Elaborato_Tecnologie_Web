function resetText(inputId){      
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

function focusLeftArticle() {
    const focusedArticle = document.querySelector(".focused-article");
    const newFocused = focusedArticle.previousElementSibling || focusedArticle.parentElement.lastElementChild;
    focusedArticle.classList.remove("focused-article");
    focusedArticle.classList.add("hidden");

    newFocused.classList.remove("hidden");
    newFocused.classList.add("focused-article");
}

function focusRightArticle() {
    const focusedArticle = document.querySelector(".focused-article");
    const newFocused = focusedArticle.nextElementSibling || focusedArticle.parentElement.firstElementChild;
    focusedArticle.classList.remove("focused-article");
    focusedArticle.classList.add("hidden");

    newFocused.classList.remove("hidden");
    newFocused.classList.add("focused-article");
}