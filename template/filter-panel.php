<form action="search.php" method="GET">
    <label for="#filterd-search"></label>
    <input type="button" id="filtered-search" value="Più filtri"/>
    <label for="min-price">Prezzo minimo</label>
    <input type="range" id="min-price" name="min-price" min="<?php $templateParams["priceRange"][0]["min"]?>" max="<?php $templateParams["priceRange"][0]["max"]?>">
    <label for="min-price-selected">Prezzo minimo selezionato</label>
    <input type="text" id="min-price-selected" value="" readonly/>
    <label for="max-price">Prezzo minimo</label>
    <input type="range" id="max-price" name="max-price" min="<?php $templateParams["priceRange"][0]["min"]?>" max="<?php $templateParams["priceRange"][0]["max"]?>">
    <label for="max-price-selected">Prezzo massimo selezionato</label>
    <input type="text" id="max-price-selected" value="" readonly/>

    <?php 
        for($i = 0; $i < count($templateParams["family"]);$i++){
            echo '<input type="checkbox" id="' . $templateParams['family'][$i]["attributo"] . '" name="' . $templateParams['family'][$i]["attributo"] . '" value="family">';
            echo '<label for="' . $templateParams['family'][$i]["attributo"] . '">' . $templateParams['family'][$i]["attributo"] . '</label>';
        }
    ?>
</form>

<!-- <?php var_dump($templateParams["family"])?> -->