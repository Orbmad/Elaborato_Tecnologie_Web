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

    resetSlidesTimer();
}

let interval; //Interval variable

/**
 * Resets the slideshow auto-scroll timer
 */
function resetSlidesTimer() {
    if (interval) {
        clearInterval(interval);
    }
    interval = setInterval(focusRightArticle, 10000);
}

/**
 * Starts the slideshow autoscroll
 */
function startRepeatingFunction() {
    resetSlidesTimer();
}

startRepeatingFunction();
