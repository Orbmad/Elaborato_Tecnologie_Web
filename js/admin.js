const defaultSection = document.querySelector("main.admin-page section.default");

//Bottone inserisci prodotto
const buttonInserisciProdotto = document.querySelector("main.admin-page section.default button.inserisci-prodotto");
if (buttonInserisciProdotto) {
    buttonInserisciProdotto.addEventListener('click', function () {
        const section = document.querySelector("main.admin-page section.inserisci-prodotto");

        defaultSection.classList.add("hidden");
        section.classList.remove("hidden");
    })
}

//Bottone crea gruppo
const buttonCreaGruppo = document.querySelector("main.admin-page section.default button.crea-gruppo");
if (buttonCreaGruppo) {
    buttonCreaGruppo.addEventListener('click', function () {
        const section = document.querySelector("main.admin-page section.crea-gruppo");

        defaultSection.classList.add("hidden");
        section.classList.remove("hidden");
    })
}

//Bottone inserisci in gruppo
document.querySelector("main.admin-page section.default button.inserisci-in-gruppo").addEventListener('click', function () {
    const section = document.querySelector("main.admin-page section.inserisci-in-gruppo");

    defaultSection.classList.add("hidden");
    section.classList.remove("hidden");
})

//Bottone rimuovi da gruppo
document.querySelector("main.admin-page section.default button.rimuovi-da-gruppo").addEventListener('click', function () {
    const section = document.querySelector("main.admin-page section.rimuovi-da-gruppo");

    defaultSection.classList.add("hidden");
    section.classList.remove("hidden");
})

//Bottone modifica ordine
document.querySelector("main.admin-page section.default button.modifica-stato-ordine").addEventListener('click', function () {
    const section = document.querySelector("main.admin-page section.modifica-stato-ordine");

    defaultSection.classList.add("hidden");
    section.classList.remove("hidden");
})

//Bottone invia notifica
document.querySelector("main.admin-page section.default button.invia-notifica").addEventListener('click', function () {
    const section = document.querySelector("main.admin-page section.invia-notifica");

    defaultSection.classList.add("hidden");
    section.classList.remove("hidden");
})

document.getElementById("fileInput-product").addEventListener("change", function () {
    let fileName = this.files.length > 0 ? this.files[0].name : "Nessun file selezionato";
    document.querySelector(".file-name-product").textContent = fileName;
    console.log("changed string");
});

document.getElementById("fileInput-group").addEventListener("change", function () {
    let fileName = this.files.length > 0 ? this.files[0].name : "Nessun file selezionato";
    document.querySelector(".file-name-group").textContent = fileName;
    console.log("changed string");
});