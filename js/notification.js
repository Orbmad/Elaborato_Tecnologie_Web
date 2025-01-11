    let $p_tags = document.querySelectorAll('main.notification ul li p');
    for(let $i = 0; $i < $p_tags.length; $i++){
        $string = $p_tags[$i].innerHTML;
        let $sub = $string.substring(0, 60);
        $p_tags[$i].innerHTML = $sub + "...";
        //console.log($p_tags[$i].innerHTML );
    }

    function modificaNotifica($content){
        let $p_tags = document.querySelectorAll('main.notification ul li p');
        let $button_tags = document.querySelectorAll('main.notification ul li button');
        for(let $i = 0; $i < $p_tags.length; $i++){
            if($p_tags[$i].innerText == ($content.substring(0,60) + "...")){
                $p_tags[$i].innerText = $content;
                $button_tags[$i].innerHTML = "Chiudi";
            }
            else {
                if($p_tags[$i].innerText == ($content)){
                $p_tags[$i].innerText = $content.substring(0, 60) + "...";
                $button_tags[$i].innerHTML = "Leggi";
            }
            }

        }
    }