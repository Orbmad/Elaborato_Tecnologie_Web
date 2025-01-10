function productRemoveClicked(button, productQt) {
    const newQt = productQt - 1;
    if (parseInt(newQt) == 1) {
        button.src = './upload/bin.png';
    }
    const data = { removed: button.id, productQt: newQt };
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
}

function productAddClicked(button, productQt) {
    const newQt = productQt + 1;
    if (parseInt(productQt) == 1) {
        button.src = './upload/minus.png';
    }
    const data = { added: button.id, productQt: newQt };
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
}