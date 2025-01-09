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
    <section class="best-products">
        <form action="search.php" method="GET">
            <h2>I migliori prodotti...</h2>
            <ul class="search-results-list">
                <?php
                    foreach($templateParams["searchResults"] as $result):
                ?>
                <li>
                    <a href="#">
                        <img src="./upload/pianta1.jpg" class="product-image" alt="product image"/>
                        <h2><?php echo $result["nome_prodotto"] ?></h2>
                        <p><?php echo $result["prezzo"] ?> €</p>
                        <p>
                        <?php 
                            $voto = $result["voto"];      
                            for ($i = 1; $i <= $voto; $i++) {
                                echo '<span class="fa fa-star checked"></span>';
                            }
                            for ($i = $voto + 1; $i <= 5; $i++) {
                                echo '<span class="fa fa-star"></span>';
                            }
                            ?>
                        </p>
                    </a>
                </li>
                <?php
                    endforeach;
                ?>
            </ul>
        </form>
    </section>
    <section class="main-categories-blocks">
        <form action="search.php" method="GET">
            <h2>Le categorie...</h2>
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
