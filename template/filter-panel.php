<form id="filtered-search" action="search.php" method="GET">
    <label for="#more-filters-btn">Visualizza più filtri</label>
    <input type="button" id="more-filters-btn" value="Più filtri" />
    <label for="#reset-filters-btn">Resetta i filtri</label>
    <input type="reset" id="reset-filters-btn" value="Reset" />
    <ul>
        <li class="filter-price hidden">
            <h3>Prezzo:</h3>
            <section class="min-price">
                <label for="min-price">Prezzo minimo</label>
                <input type="range" id="min-price" name="min-price"
                    min="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>"
                    max="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>"
                    value="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>" step="0.1">
                <label for="min-price-selected">Prezzo minimo selezionato</label>
                <input type="text" id="min-price-selected" value="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>" readonly />
            </section>
            <section class="max-price">
                <label for="max-price">Prezzo massimo</label>
                <input type="range" id="max-price" name="max-price"
                    min="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>"
                    max="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>"
                    value="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>" step="0.2">
                <label for="max-price-selected">Prezzo massimo selezionato</label>
                <input type="text" id="max-price-selected" value="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>" readonly />
            </section>
        </li>
        <li class="filter-checkbox hidden">
            <h3>Categoria</h3>
            <ul>
                <?php foreach($templateParams["categorie"] as $category){
                    $category = $category["nome_categoria"];
                    echo "<li>";
                    echo '<input type="checkbox" id="' . $category . '" name="' . $category . '" value="'. $category .'">';
                    echo '<label for="' . $category . '">' . $category . '</label>';
                    echo "</li>";
                }?>
            </ul>
        </li>
        <?php $filterAttributes = array("famiglia", "genere", "specie", "dimensioni","profumo","tipo di foglia","colore delle foglie");
            foreach ($filterAttributes as $filterAttribute):
        ?>
        <li class="filter-checkbox filter-<?php echo $filterAttribute ?> hidden">
            <h3><?php echo $filterAttribute ?></h3>
            <ul>
                <?php
                for ($i = 0; $i < count($templateParams[$filterAttribute]); $i++) {
                    echo "<li>";
                    echo '<input type="checkbox" id="' . $templateParams[$filterAttribute][$i]["attributo"] . '" name="' . $templateParams[$filterAttribute][$i]["attributo"] . '" value="'. $filterAttribute .'">';
                    echo '<label for="' . $templateParams[$filterAttribute][$i]["attributo"] . '">' . $templateParams[$filterAttribute][$i]["attributo"] . '</label>';
                    echo "</li>";
                }
                ?>
            </ul>
        </li>
        <?php endforeach;?>
    </ul>
</form>