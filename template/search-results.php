<ul>
    <?php
    if (isset($_GET['fastSearch'])) {
        $result = $dbh->searchProductByName($_GET['fastSearch']);
        var_dump($result);
    } else {

        // Alternate code
    }
    ?>
</ul>