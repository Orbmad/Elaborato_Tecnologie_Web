function addQuantity(maxValue) {
    const plus = document.querySelector("main.single-item > article > header > section > div.wrapper > span.plus");
    const num = document.querySelector("main.single-item > article > header > section > div.wrapper > span.number");
    let a = num.innerHTML;
    if (a < maxValue) {
        a++;
        num.innerHTML = "";
        if (a < 10) {
            num.innerHTML += "0";
        }
        num.innerHTML += a;
    }
}

function reduceQuantity() {
    const minus = document.querySelector("main.single-item > article > header > section > div.wrapper > span.minus");
    const num = document.querySelector("main.single-item > article > header > section > div.wrapper > span.number");
    let a = num.innerHTML;
    if (a > 1) {
        a--;
        num.innerHTML = "";
        if (a < 10) {
            num.innerHTML += "0";
        }
        num.innerHTML += a;
    }
}

function getQuantity() {
    const num = document.querySelector("main.single-item > article > header > section > div.wrapper > span.number");
    let a = num.innerHTML;
    return a;
}

function showErrorMessage() {
    const span = document.querySelector('span.hidden');
    if (span != null) {
        console.log(22);
        if(span.classList.contains('hidden')){
            span.classList.remove('hidden');
            span.classList.add('show');
        }
    }
}

function addToCart(id_prodotto) {
    console.log(this.getQuantity(), id_prodotto);
    console.log("ENTRATO!");
    let quan = getQuantity();
    if (quan < 10) {
        quan = quan.substring(1, quan.length);
    }
    //console.log(quan);
    const data = { productQuant: quan, productId: id_prodotto, messaggio: "L'oggetto è stato aggiunto al carrello"};
    fetch('product.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Errore nella risposta dal server');
            }
            return response.text();
        })
        .then(data => {
            document.body.innerHTML = data;
        })
        .catch(error => console.error('Errore:', error));
}

//Gestione della parte dedicata all'admin
function updateProduct() {
    let updateProductSection = document.querySelector("main.single-item section.admin-product section");

    console.log("click");

    updateProductSection.classList.toggle("hidden");
}

const imgUpload = document.getElementById("fileInput-product");

if (imgUpload) {
    imgUpload.addEventListener("change", function () {
        let fileName = this.files.length > 0 ? this.files[0].name : "Nessun file selezionato";
        document.querySelector(".file-name-product").textContent = fileName;
        console.log("changed string");
    });
}
