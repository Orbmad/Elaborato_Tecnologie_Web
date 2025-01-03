function resetText(inputId){      
    const inputField = document.getElementById(inputId);
    
    if (inputField) {
        inputField.value = "";
    } else {
        console.error("Input field not found!");
    }
    showSuggestions();
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
    const focusedArticle = document.querySelector(".main-articles ul li.focused-article");
    const leftArticle = document.querySelector(".main-articles ul li.hidden.left");
    const rightArticle = document.querySelector(".main-articles ul li.hidden.right");

    focusedArticle.classList.remove("focused-article");
    focusedArticle.classList.add("hidden","right");

    leftArticle.classList.remove("hidden","left");
    leftArticle.classList.add("focused-article");

    rightArticle.classList.remove("right");
    rightArticle.classList.add("left");
}

function focusRightArticle() {
    const focusedArticle = document.querySelector(".main-articles ul li.focused-article");
    const leftArticle = document.querySelector(".main-articles ul li.hidden.left");
    const rightArticle = document.querySelector(".main-articles ul li.hidden.right");

    focusedArticle.classList.remove("focused-article");
    focusedArticle.classList.add("hidden","left");

    rightArticle.classList.remove("hidden","right");
    rightArticle.classList.add("focused-article");

    leftArticle.classList.remove("left");
    leftArticle.classList.add("right");
}

/**
 * Function used to show suggestions for the searchbar while the user is typing.
 * The suggestions list is updated at each letter typed by the user, starting after
 * the first two letters are typed.
 */
async function showSuggestions() {
    const text = document.querySelector("#fastsearch").value;
    if(text.length>2){
        document.querySelector(".suggestions").classList.remove("not-showing");
    }else{
        document.querySelector(".suggestions").classList.add("not-showing");
    }
}


function addQuantity(maxValue){
    const plus = document.querySelector("main > article > div.wrapper > span.plus");
    const num = document.querySelector("main > article > div.wrapper > span.number");
    let a = num.innerHTML;
    if(a < maxValue){
        a++;
        num.innerHTML = "";
        if(a < 10){
            num.innerHTML += "0";
        }
    num.innerHTML += a;
    }
}

function reduceQuantity(){
    const minus = document.querySelector("main > article > div.wrapper > span.minus");
    const num = document.querySelector("main > article > div.wrapper > span.number");
    let a = num.innerHTML;
    if(a > 1){
        a--;
        num.innerHTML = "";
        if(a < 10){
            num.innerHTML += "0";
        }
        num.innerHTML += a;
    }
}