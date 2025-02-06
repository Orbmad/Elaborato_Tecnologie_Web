const orderButton = document.getElementById("order-input");

function debug() {
    console.log("OrderButton: " + orderButton.classList);
}

function productRemoveClicked(button, productQt) {
    const newQt = productQt - 1;
    if (parseInt(newQt) == 1) {
        button.src = './upload/bin.png';
    }
    const data = { removed: button.classList.value, productQt: newQt };
    fetch('cart.php', {
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

    //stock check
}

function productAddClicked(button, productQt) {
    const newQt = productQt + 1;
    if (parseInt(productQt) == 1) {
        button.src = './upload/minus.png';
    }
    const data = { added: button.classList.value, productQt: newQt };
    fetch('cart.php', {
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

    //stock check
}

function disableButton() {
    orderButton.disabled = true;
    orderButton.classList.add("disabled");
    orderButton.value = "Articoli non disponibili";
    console.log("disabled");

}

function reableButton() {
    orderButton.disabled = false;
    orderButton.classList.remove("disabled");
    orderButton.value = "Procedi all'ordine";
    console.log("enabled");

}

function getProductStock(productName) {
    let selector = "ul li.detail." + productName;
    let product = document.querySelector(selector);

    let stock = product.classList.value; //classes string

    stock = stock.split(' ').filter(c => c.startsWith("stock"))[0].slice(5);

    stock = parseInt(stock, 10);

    return stock;
}

function getAllStocks() {
    let selector = "ul li.detail";
    let products = document.querySelectorAll(selector);
    let stockArray = [];

    products.forEach(function (element) {
        let stock = element.classList.value;
        stock = stock.split(' ').filter(c => c.startsWith("stock"))[0].slice(5);
        stock = parseInt(stock, 10);

        stockArray.push(stock);
    });

    return stockArray;
}

function getAllQuantities() {
    let paragraphs = document.querySelectorAll("section.qt-selection p");
    let qtArray = [];

    paragraphs.forEach(function (element) {
        qtArray.push(parseInt(element.textContent))
    });

    return qtArray;
}


//default
function updateButton() {
    let stockArray = getAllStocks();
    console.log(stockArray);
    let qtArray = getAllQuantities();
    console.log(qtArray);
    let flag = true;

    for (let i = 0; i < stockArray.length; i++) {
        if (qtArray[i] > stockArray[i]) {
            disableButton();
            flag = false;
        }
    }
    if (flag) {
        reableButton();
        console.log("ecco il problema!!!");
    }
}

//updateButton();
  