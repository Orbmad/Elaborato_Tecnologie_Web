<main>
    <section class="main-articles">
        <img src="./upload/left-arrow-icon.png" class="left-arrow-icon arrow-icon" onclick="focusLeftArticle()"  alt="Arrow pointing left"/>
        <img src="./upload/right-arrow-icon.png" class="right-arrow-icon arrow-icon" onclick="focusRightArticle()" alt="Arrow pointing right"/>
        <ul>
            <li class="hidden left">
                <article>
                    <img src="upload/pianta1.jpg" alt="Immagine dell'articolo"/>
                    <section class ="article-body">
                        <h2><?php echo $templateParams["randomArticles"][0]["nomeGruppo"]?></h2>
                        <p><?php echo $templateParams["randomArticles"][0]["descrizioneGruppo"]?></p>
                        <section class="button-sec">
                        <input type="button" value="SCOPRI ARTICOLO"></input>
                        </section class="button-sec">
                    </section>
                </article>
            </li><li class="focused-article">
                <article>
                    <img src="upload/pianta.jpg" alt="Immagine dell'articolo"/>
                    <section class ="article-body">
                        <h2><?php echo $templateParams["randomArticles"][1]["nomeGruppo"]?></h2>
                        <p><?php echo $templateParams["randomArticles"][1]["descrizioneGruppo"]?></p><section class="button-sec">
                        <input type="button" value="SCOPRI ARTICOLO"></input>
                        </section class="button-sec">
                    </section>
                </article>
            </li><li class="hidden right">
                <article>
                    <img src="upload/pianta.jpg" alt="Immagine dell'articolo"/>
                    <section class ="article-body">
                        <h2><?php echo $templateParams["randomArticles"][2]["nomeGruppo"]?></h2>
                        <p><?php echo $templateParams["randomArticles"][2]["descrizioneGruppo"]?></p>
                        <section class="button-sec">
                        <input type="button" value="SCOPRI ARTICOLO"></input>
                        </section class="button-sec">
                    </section>
                </article>
            </li>
        </ul>
    </section>
    <section class="main-categories-blocks">
        <form action="search.php" method="GET">
            <ul>
                <?php foreach($templateParams["randomCategories"] as $category): ?>
                <li>
                    <img src="upload/pianta.jpg" alt="group image"/>
                    <section>
                        <input name="categoriaSelezionata" type="text" value="<?php echo $category["nome_categoria"]?>" readonly/>
                        <input type="submit" value="Scopri"/>
                    </section>
                </li>
                <?php endforeach; ?>
            </ul>
        <form>
    </section>
<main>
