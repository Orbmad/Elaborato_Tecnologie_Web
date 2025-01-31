<main class="address-page">
    <section>
        <h1>I tuoi indirizzi</h1>
        <ul>
            <?php foreach($templateParams["addresses"] as $address): ?>
                <li>
                    <p>Via: <?php echo $address["via"]; ?></p>
                    <p>Città: <?php echo $address["citta"]; ?></p>
                    <p>Provincia: <?php echo $address["provincia"]; ?></p>
                    <p>Cap: <?php echo $address["cap"]; ?></p>
                    <p>Nazione: <?php echo $address["nazione"]; ?></p>

                    <form action="utils/api-deleteAddress.php" method="POST" >
                        <input type="hidden" name="address_id" value="<?php echo $address["id_indirizzo"]; ?>" />
                        <button type="submit">Elimina</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>