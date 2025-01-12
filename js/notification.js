    let $p_tags = document.querySelectorAll('main.notification ul li p');
    for(let $i = 0; $i < $p_tags.length; $i++){
        $string = $p_tags[$i].innerHTML;
        let $sub = $string.substring(0, 60);
        $p_tags[$i].innerHTML = $sub + "...";
        /*console.log($p_tags[$i].innerHTML );*/
    }

    /*OK PER IL BOTTONE
    function modificaNotifica($content){
        let $p_tags = document.querySelectorAll('main.notification ul li p');
        let $button_tags = document.querySelectorAll('main.notification ul li button');
        let $image_tag = document.querySelector('main.notification ul li img');
        for(let $i = 0; $i < $p_tags.length; $i++){
            if($p_tags[$i].innerText == ($content.substring(0,60) + "...")){
                $p_tags[$i].innerText = $content;
                $button_tags[$i].innerHTML = "Chiudi";
                if($image_tag != null){//rimozione dell'immagine se viene letta la notifica
                    $image_tag.style.display = "none";
                    //si prende tag con numero di notifiche e la si cambia in #corretto
                    
                }
            }
            else {
                if($p_tags[$i].innerText == ($content)){
                    $p_tags[$i].innerText = $content.substring(0, 60) + "...";
                    $button_tags[$i].innerHTML = "Leggi";
                }
            }

        }
    }*/

        function modificaNotifica(content, numberOfNotification){
            let p_tags = document.querySelectorAll('main.notification ul li p');
            let button_tags = document.querySelectorAll('main.notification ul li button');
            let image_tag = document.querySelectorAll('main.notification ul li img');
            for(let i = 0; i < p_tags.length; i++){
                if(p_tags[i].innerText == (content.substring(0,60) + "...")){
                    console.log();
                    p_tags[i].innerText = content;
                    console.log(button_tags[i].innerHTML);
                    button_tags[i].innerHTML = "Chiudi";
                    console.log(button_tags[i].innerHTML);
                    if(image_tag[i].classList.contains('show')){//rimozione dell'immagine se viene letta la notifica
                        //alert(image_tag[i].innerHTML);
                        image_tag[i].classList.remove('show');
                        image_tag[i].classList.add('hidden');
                        image_tag[i].style.display = "none";
                        //si prende tag con numero di notifiche e la si cambia in #corretto
                        let numberNotificationTag = document.querySelector('body > header p');
                        console.log(numberNotificationTag.innerHTML);
                        numberNotificationTag.innerHTML = numberNotificationTag.innerHTML - 1;
                        console.log(numberNotificationTag.innerHTML);
                        /*Quando il bottone è chiamato la prima volta -> effettuo query definendo data*/
                        const data = { message: content };
                        fetch('notification.php', {
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
                }
            }
                else {
                    if(p_tags[i].innerText == (content)){
                        console.log("ok");
                        p_tags[i].innerText = content.substring(0, 60) + "...";
                        button_tags[i].innerHTML = "Leggi";
                    }
                }
        }
    }

    function ciao(){
        console.log("called!!");
    }

    function aggiorna($val){
        console.log("val");
    }
/*Modifica perchè funzioni con input button 
        function modificaNotifica($content){
            let $p_tags = document.querySelectorAll('main.notification ul li p');
            let $button_tags = document.querySelectorAll('main.notification ul li input');
            for(let $i = 0; $i < $p_tags.length; $i++){
                if($p_tags[$i].innerText == ($content.substring(0,60) + "...")){
                    $p_tags[$i].innerText = $content;
                    $button_tags[$i].value = "Chiudi";
                }
                else {
                    if($p_tags[$i].innerText == ($content)){
                    $p_tags[$i].innerText = $content.substring(0, 60) + "...";
                    $button_tags[$i].value = "Leggi";
                }
                }
    
            }
        }*/