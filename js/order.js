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

document.getElementById("address-form").addEventListener('submit', function (event) {
    event.preventDefault();
    document.querySelectorAll("#address-form li").forEach(function (li) {
        li.classList.add("not-showing");
    });
    document.querySelectorAll("#payment-form li").forEach(function (li) {
        li.classList.remove("not-showing");
    });
    document.getElementById("address-check-btn").classList.remove("not-showing");
})

document.getElementById("address-check-btn").addEventListener('click', function (event) {
    document.querySelectorAll("#payment-form li").forEach(function (li) {
        li.classList.add("not-showing");
    });
    document.querySelectorAll("#address-form li").forEach(function (li) {
        li.classList.remove("not-showing");
    });
    document.getElementById("address-check-btn").classList.add("not-showing");
})

document.getElementById("payment-method").addEventListener('change', hideInputs);

function hideInputs() {
    let liElement = document.getElementById("pay-method-li"); 
    const methodSelected = document.getElementById("payment-method").value;
    document.querySelectorAll(".switchable-field").forEach(element => element.remove());
    if (methodSelected == 2) {
        const formText = `
            <li class="switchable-field" id="pay-email-li">
                <label for="pay-email">Email</label>
                <input type="email" id="pay-email" name="pay-email" required autocomplete="email" />
            </li>
        `;
        liElement.insertAdjacentHTML("afterend",formText);
    } else {
        const formText = `
            <li class="switchable-field">
                <label for="pay-numero">Numero di carta</label>
                <input type="text" id="pay-numero" name="pay-numero" required pattern="[0-9]{13,19}"
                    title="Inserisci un numero di carta valido (13-19 cifre)" />
            </li>
            <li class="switchable-field">
                <label for="pay-date">Data di scadenza</label>
                <input type="month" id="pay-date" name="pay-date" required min="2024-02"
                    title="Seleziona una data di scadenza valida" />
            </li>
            <li class="switchable-field">
                <label for="pay-cvv">CVV</label>
                <input type="text" id="pay-cvv" name="pay-cvv" required maxlength="4" pattern="[0-9]{3,4}"
                    title="Il CVV deve essere di 3 o 4 cifre" />
            </li>
        `;
        liElement.insertAdjacentHTML("afterend",formText);
    }
    // const methodSelected = document.getElementById("payment-method").value;
    // document.querySelector("#payment-form li:first-of-type").classList.remove("not-showing");
    // if (methodSelected == 2) {
    //     document.querySelectorAll("#payment-form li:not(:first-of-type):not(:last-of-type)").forEach(function (li) {
    //         li.classList.add("not-showing");
    //     });
    //     document.getElementById("pay-email-li").classList.remove("not-showing");
    //     document.getElementById("pay-email-li").lastElementChild.setAttribute("required", "false");
    //     document.getElementById("pay-numero").setAttribute("required", "true");
    //     document.getElementById("pay-date").setAttribute("required", "true");
    //     document.getElementById("pay-cvv").setAttribute("required", "true");
    // } else {
    //     document.querySelectorAll("#payment-form li:not(:first-of-type)").forEach(function (li) {
    //         li.classList.remove("not-showing");
    //     });
    //     document.getElementById("pay-email-li").classList.add("not-showing");
    //     document.getElementById("pay-email-li").setAttribute("required", "true");
    //     document.getElementById("pay-numero").setAttribute("required", "false");
    //     document.getElementById("pay-date").setAttribute("required", "false");
    //     document.getElementById("pay-cvv").setAttribute("required", "false");
    // }
}