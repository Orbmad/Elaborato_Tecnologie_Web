function addQuantity(maxValue){
    const plus = document.querySelector("main.single-item > article > header > section > div.wrapper > span.plus");
    const num = document.querySelector("main.single-item > article > header > section > div.wrapper > span.number");
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
    const minus = document.querySelector("main.single-item > article > header > section > div.wrapper > span.minus");
    const num = document.querySelector("main.single-item > article > header > section > div.wrapper > span.number");
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

function getQuantity(){
    const num = document.querySelector("main.single-item > article > header > section > div.wrapper > span.number");
    let a = num.innerHTML;
    return a;
}

function addToCart(id_prodotto){
    //console.log(this.getQuantity(), id_prodotto);
    let quan = getQuantity();
    if(quan < 10){
        quan = quan.substring(1,quan.length);
    }
    //console.log(quan);
    const data = { productQuant: quan, productId: id_prodotto };
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