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