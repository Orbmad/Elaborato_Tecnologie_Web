<form action="search.php" method="GET">
    <label for="#filterd-search"></label>
    <input type="button" id="filtered-search" value="Più filtri"/>
    <label for="price-range">Range di prezzo</label>
    <input type="range" id="price-range" name="vol" min="<?php $templateParams["priceRange"]["min"]?>" max="<?php $templateParams["priceRange"]["max"]?>">

</form>