<main>
    <section class="main-articles">
        <h2 class='hidden'>>Gruppi di prodotti </h2>
        <img src="./upload/left-arrow-icon.png" class="left-arrow-icon arrow-icon" onclick="focusLeftArticle()"
            alt="Arrow pointing left" />
        <img src="./upload/right-arrow-icon.png" class="right-arrow-icon arrow-icon" onclick="focusRightArticle()"
            alt="Arrow pointing right" />
        <ul>
            <li class="hidden left">
                <?php echo createArticle($templateParams["randomArticles"][0]) ?>
            </li>
            <li class="focused-article">
                <?php echo createArticle($templateParams["randomArticles"][1]) ?>
            </li>
            <li class="hidden right">
                <?php echo createArticle($templateParams["randomArticles"][2]) ?>
            </li>
        </ul>
    </section>
    <section class="best-products">
        <h2>I migliori prodotti...</h2>
        <ul class="search-results-list">
            <?php foreach ($templateParams["searchResults"] as $result) {
                if (isset($_SESSION["email"])) {
                    $cartSign = $dbh->hasUserProductInCart($_SESSION["email"], $result["nome_prodotto"]);
                } else {
                    $cartSign = false;
                }
                echo generateProductBox($result, $cartSign);
            } ?>
        </ul>
    </section>
    <section class="main-categories-blocks">
        <h2>Le categorie...</h2>
        <ul>
            <?php foreach ($templateParams["randomCategories"] as $category) {
                echo generateCAtegoryBox($category);
            } ?>
        </ul>
    </section>
</main>