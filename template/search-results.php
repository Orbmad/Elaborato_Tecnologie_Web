<ul class="search-results-list">
    <?php
        foreach($templateParams["searchResults"] as $result):
    ?>
    <li>
        <a>
            <img src="./upload/pianta1.jpg" class="product-image" alt="product image"/>
            <h2><?php echo $result["nome_prodotto"] ?></h2>
            <p></p>
            <p></p>
        </a>
    </li>
    <?php
        endforeach;
    ?>
</ul>