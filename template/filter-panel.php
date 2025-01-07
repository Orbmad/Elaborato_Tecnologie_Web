<form action="search.php" method="GET">
    <label for="#filterd-search"></label>
    <input type="button" id="filtered-search" value="Più filtri"/>
    <section class="filter-price">
        <h3>Prezzo:</h3>
        <section class="min-price">
            <label for="min-price">Prezzo minimo</label>
            <input type="range" id="min-price" name="min-price" min="<?php echo floatval($templateParams["priceRange"][0]["min"])?>" max="<?php echo floatval($templateParams["priceRange"][0]["max"])?>" value="<?php echo floatval($templateParams["priceRange"][0]["min"])?>" step="0.1">
            <label for="min-price-selected">Prezzo minimo selezionato</label>
            <input type="text" id="min-price-selected" value="" readonly/>
        </section>
        <section class="max-price">
            <label for="max-price">Prezzo massimo</label>
            <input type="range" id="max-price" name="max-price" min="<?php echo floatval($templateParams["priceRange"][0]["min"])?>" max="<?php echo floatval($templateParams["priceRange"][0]["max"])?>" value="<?php echo floatval($templateParams["priceRange"][0]["max"])?>" step="0.2">
            <label for="max-price-selected">Prezzo massimo selezionato</label>
            <input type="text" id="max-price-selected" value="" readonly/>
        </section>
    </section>

    <section class="filter-family">
        <h3>Famiglia:</>
    </section>
    <?php 
        for($i = 0; $i < count($templateParams["family"]);$i++){
            echo '<input type="checkbox" id="' . $templateParams['family'][$i]["attributo"] . '" name="' . $templateParams['family'][$i]["attributo"] . '" value="family">';
            echo '<label for="' . $templateParams['family'][$i]["attributo"] . '">' . $templateParams['family'][$i]["attributo"] . '</label>';
        }
    ?>
</form>

<!-- <?php var_dump($templateParams["family"])?> -->