<form action="search.php" method="GET">
    <label for="#filterd-search"></label>
    <input type="button" id="filtered-search" value="Più filtri" />
    <section class="filter-price">
        <h3>Prezzo:</h3>
        <section class="min-price">
            <label for="min-price">Prezzo minimo</label>
            <input type="range" id="min-price" name="min-price"
                min="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>"
                max="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>"
                value="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>" step="0.1">
            <label for="min-price-selected">Prezzo minimo selezionato</label>
            <input type="text" id="min-price-selected" value="" readonly />
        </section>
        <section class="max-price">
            <label for="max-price">Prezzo massimo</label>
            <input type="range" id="max-price" name="max-price"
                min="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>"
                max="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>"
                value="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>" step="0.2">
            <label for="max-price-selected">Prezzo massimo selezionato</label>
            <input type="text" id="max-price-selected" value="" readonly />
        </section>
    </section>

    <?php $filterAttributes = array("famiglia", "genere", "specie", "dimensioni","profumo","tipo di foglia","colore delle foglie");
        foreach ($filterAttributes as $filterAttribute):
    ?>
    <section class="filter-checkbox filter-<?php echo $filterAttribute ?>">
        <h3><?php echo $filterAttribute ?></h3>
        <?php
        for ($i = 0; $i < count($templateParams[$filterAttribute]); $i++) {
            echo "<section>";
            echo '<input type="checkbox" id="' . $templateParams[$filterAttribute][$i]["attributo"] . '" name="' . $templateParams[$filterAttribute][$i]["attributo"] . '" value="'. $filterAttribute .'">';
            echo '<label for="' . $templateParams[$filterAttribute][$i]["attributo"] . '">' . $templateParams[$filterAttribute][$i]["attributo"] . '</label>';
            echo "</section>";
        }
        ?>
    </section>
    <?php endforeach;?>
</form>