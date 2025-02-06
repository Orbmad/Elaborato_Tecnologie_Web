/*colorazione stelline al click dell'utente*/
const star = document.getElementsByClassName('fa fa-star');
for(let i = 0; i < star.length; i++){
    star[i].addEventListener("click", function(){//aggiunge ad ognuna un event listener
        const num = star[i].classList[2];//prelevo il numero della stellina nella fila 1-5
        let index = i + 1;
        //decoloro tutte quelle successive della stessa fila
        for(let j = num; j < 5; j++){
            
            if(star[index].classList.contains('checked')){
                star[index].classList.remove('checked');
            }
            index++;
        }
        index = i;
        for(let j = 1; j <= num; j++){
            
            star[index].classList.add('checked');
            index--;
        }
    });
}


/*aggiunta event listener per ogni bottone 'lascia recensione'*/
const buttons = document.querySelectorAll('section.info-item-in-order button');
for(let i = 0; i < buttons.length; i++){
buttons[i].addEventListener("click", function(){
    buttons[i].style.display = "none";
    const section_review = document.querySelectorAll('section.leave-review');
    console.log(i);
    console.log('cliccato!!!');
    section_review[i].classList.remove('hidden');
    section_review[i].classList.add('show');
});
}
/*function addReviewInfos(){
document.querySelector('section.info-item-in-order button').style.display = "none";
let section_review = document.querySelector('section.leave-review');
section_review.classList.remove('hidden');
section_review.classList.add('show');
}*/

/*-aggiunta event listener per tutti i bottoni invia
-rimozione section review
-reperimento dei dati inseriti*/
/*const stars = document.getElementsByClassName('section.leave-review fa fa-star');
console.log(stars.length);*/
//console.log(star.length);
const name_items = document.querySelectorAll('section.order-item p.name');

const buttons_submit = document.querySelectorAll('section.leave-review button');
for(let i = 0; i < buttons_submit.length; i++){
buttons_submit[i].addEventListener("click", function(){
    const sections_review = document.querySelectorAll('section.leave-review');
    //numero stelline checked
    let index = (i + 1) * 5 - 5;
    let review_value = 0;
    for(let j = 0; j < 5; j++){
        if(star[index].classList.contains('checked')){
            review_value++;
        }
        index++;
    }
    if(review_value > 0){
        sections_review[i].classList.remove('show');
        sections_review[i].classList.add('hidden');
    //se c'è lo stesso articolo in altri ordini allora si toglie la 
    //possibilità di lasciare una recensione

    for(let j = 0; j < name_items.length; j++){
        if(name_items[j].innerText == name_items[i].innerText){
            if(buttons[j].style.display != "none"){
                buttons[j].style.display = "none";
            }
        }
    }


    //prelevamento id prodotto
    const products_id = document.querySelectorAll('section.order-item p.name');
    let id_prodotto = products_id[i].innerText;
    //prelevamento della recensione scritta dall'utente
    const content_review = document.querySelectorAll('section.leave-review textarea');
    let text = content_review[i].value;
    const data = { rating: review_value, productId: id_prodotto, review: text};
    console.log(data);
    fetch('orders.php', {
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
        /*.then(data => {
            document.body.innerHTML = data;
        })*/
        .catch(error => console.error('Errore:', error));
    } else {
        const error = document.querySelectorAll('section.leave-review p');
        console.log(error);
        error[i].classList.remove('hidden');
        error[i].classList.add('show');
        //console.log(name_items[i].innerText);
    }
    })
}