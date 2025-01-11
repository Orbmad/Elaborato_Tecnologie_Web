const defaultSection = document.querySelector("main.admin-page section.default");

//Bottone inserisci prodotto
document.querySelector("main.admin-page section.default button.inserisci-prodotto").addEventListener('click', function() {
    const section = document.querySelector("main.admin-page section.inserisci-prodotto");

    defaultSection.classList.add("hidden");
    section.classList.remove("hidden");
})

//Bottone crea gruppo
document.querySelector("main.admin-page section.default button.crea-gruppo").addEventListener('click', function() {
    const section = document.querySelector("main.admin-page section.crea-gruppo");

    defaultSection.classList.add("hidden");
    section.classList.remove("hidden");
})

//Bottone inserisci in gruppo
document.querySelector("main.admin-page section.default button.inserisci-in-gruppo").addEventListener('click', function() {
    const section = document.querySelector("main.admin-page section.inserisci-in-gruppo");

    defaultSection.classList.add("hidden");
    section.classList.remove("hidden");
})

//Bottone rimuovi da gruppo
document.querySelector("main.admin-page section.default button.rimuovi-da-gruppo").addEventListener('click', function() {
    const section = document.querySelector("main.admin-page section.rimuovi-da-gruppo");

    defaultSection.classList.add("hidden");
    section.classList.remove("hidden");
})