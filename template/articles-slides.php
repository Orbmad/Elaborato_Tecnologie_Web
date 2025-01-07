<section class="main-articles">
    <img src="./upload/left-arrow-icon.png" class="left-arrow-icon arrow-icon" onclick="focusLeftArticle()"  alt="Arrow pointing left"/>
    <img src="./upload/right-arrow-icon.png" class="right-arrow-icon arrow-icon" onclick="focusRightArticle()" alt="Arrow pointing right"/>
    <ul>
        <li class="hidden left">
            <article>
                <img src="upload/pianta1.jpg" alt="Immagine dell'articolo"/>
                <section class ="article-body">
                    <h2><?php echo $templateParams["randomArticles"][0]["nomegruppo"]?></h2>
                    <p><?php echo $templateParams["randomArticles"][0]["descrizionegruppo"]?></p>
                    <section class="button-sec">
                    <input type="button" value="SCOPRI ARTICOLO"></input>
                    </section class="button-sec">
                </section>
            </article>
        </li><li class="focused-article">
            <article>
                <img src="upload/pianta.jpg" alt="Immagine dell'articolo"/>
                <section class ="article-body">
                    <h2><?php echo $templateParams["randomArticles"][1]["nomegruppo"]?></h2>
                    <p><?php echo $templateParams["randomArticles"][1]["descrizionegruppo"]?></p><section class="button-sec">
                    <input type="button" value="SCOPRI ARTICOLO"></input>
                    </section class="button-sec">
                </section>
            </article>
        </li><li class="hidden right">
            <article>
                <img src="upload/pianta.jpg" alt="Immagine dell'articolo"/>
                <section class ="article-body">
                    <h2><?php echo $templateParams["randomArticles"][2]["nomegruppo"]?></h2>
                    <p><?php echo $templateParams["randomArticles"][2]["descrizionegruppo"]?></p>
                    <section class="button-sec">
                    <input type="button" value="SCOPRI ARTICOLO"></input>
                    </section class="button-sec">
                </section>
            </article>
        </li>
    </ul>
</section>