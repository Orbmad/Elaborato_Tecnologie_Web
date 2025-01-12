const timeOut = 60000000;
let secondsLeft = timeOut;

window.setTimeout(redirectToCart, timeOut);

function updateTimer() {
    secondsLeft -= 1000;
    document.getElementById('timeOut').textContent = secondsLeft / 1000;
}


function redirectToCart() {
    window.location.href = "cart.php";
}

setInterval(updateTimer, 1000);