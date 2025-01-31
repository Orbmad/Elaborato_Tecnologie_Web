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
document.getElementById("address-selection").addEventListener('change', hideAddressInputs);

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
        liElement.insertAdjacentHTML("afterend", formText);
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
        liElement.insertAdjacentHTML("afterend", formText);
    }
}

function hideAddressInputs() {
    let liElement = document.getElementById("address-selection-li");
    const addressTypeSelected = document.getElementById("address-selection").value;
    document.querySelectorAll(".switchable-address-field").forEach(element => element.remove());
    if (addressTypeSelected != "nuovo") {
        const formText = ``;
        liElement.insertAdjacentHTML("afterend", formText);
    } else {
        const formText = `
           <li class="switchable-address-field">
                        <label for="addr-via">Via</label>
                        <input type="text" id="addr-via" name="addr-via" required />
                    </li>
                    <li class="switchable-address-field">
                        <label for="addr-citta">Città</label>
                        <input type="text" id="addr-citta" name="addr-citta" required />
                    </li>
                    <li class="switchable-address-field">
                        <label for="addr-provincia">Provincia</label>
                        <input type="text" id="addr-provincia" name="addr-provincia" required />
                    </li>
                    <li class="switchable-address-field">
                        <label for="addr-cap">Cap</label>
                        <input type="text" id="addr-cap" name="addr-cap" maxlength="5" pattern="[0-9]{5}" required />
                    </li>
                    <li class="switchable-address-field">
                        <label for="addr-nazione">Nazione</label>
                        <select class="form-select" autocomplete="nazione" id="addr-nazione" name="nazione">
                            <option value="IT">Italia</option>
                            <option value="SM">San Marino</option>
                            <option value="CH">Svizzera</option>
                            <option value="VA">Cittá del vaticano</option>
                        </select>
                    </li>
                    <li class="checkbox-field switchable-address-field">
                        <label for="addr-save">Desideri salvare l'indirizzo?</label>
                        <input type="checkbox" id="addr-save" name="addr-save">
                    </li>
        `;
        liElement.insertAdjacentHTML("afterend", formText);
    }

}

document.getElementById("payment-form").addEventListener('submit', function (event) {
    event.preventDefault();
    const addressType = document.getElementById("address-selection").value;
    let datiIndirizzo;
    let datiPagamento;
    if (addressType == "nuovo") {
        datiIndirizzo = {
            via: document.getElementById("addr-via").value,
            citta: document.getElementById("addr-citta").value,
            cap: document.getElementById("addr-cap").value,
            provincia: document.getElementById("addr-provincia").value,
            nazione: document.getElementById("addr-nazione").value,
            save: document.getElementById("addr-save").checked
        };
    } else {
        datiIndirizzo = {
            idIndirizzo: addressType
        };
    }
    const methodSelected = document.getElementById("payment-method").value;
    if (methodSelected == 2) {
        datiPagamento = {
            email: document.getElementById("pay-email").value
        };
    } else {
        datiPagamento = {
            numero: document.getElementById("pay-numero").value,
            scadenza: document.getElementById("pay-date").value,
            cvv: document.getElementById("pay-cvv").value
        };
    }

    const dati = {
        user: document.getElementById("loggedUser").value,
        totalPrice: document.getElementById("costoTotale").value,
        datiPagamento: datiPagamento,
        datiIndirizzo: datiIndirizzo
    }
    
    fetch("processa-ordine.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(dati)
    })
        .then(response => response.text())
        .then(text => {
            console.log("Risposta dal server:", text);
        })

});