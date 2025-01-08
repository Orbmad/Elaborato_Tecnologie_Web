<main class="search-results-main">
    <ul class="search-results-list">
        <?php
            foreach($templateParams["searchResults"] as $result):
        ?>
        <li>
            <a>
                <img src="./upload/pianta1.jpg" class="product-image" alt="product image"/>
                <h2><?php echo $result["nome_prodotto"] ?></h2>
                <p><?php echo $result["prezzo"] ?> €</p>
                <p>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
            </a>
        </li>
        <?php
            endforeach;
        ?>
    </ul>
</main>