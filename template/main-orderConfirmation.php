<main class="main-order-recap">
    <section class="order-recap">
        <?php if (isset($templateParams["cartProducts"])): ?>
            <section class="order-recap-header">
                <h2>Riepilogo Ordine</h2>
                <p>Tempo rimasto per completare l'ordine: <span id="timeOut"></span> secondi</p>
            </section>
            <ul>
                <?php foreach ($templateParams["cartProducts"] as $cartProduct): ?>
                    <li>
                        <img onclick="window.location.href='product.php?id=<?php echo $cartProduct['nome_prodotto'] ?>'"
                            src="./upload/prodotti/<?php echo $cartProduct['nome_prodotto'] ?>.jpg"
                            alt="Immagine del prodotto" />
                        <h3>
                            <?php echo $cartProduct["nome_prodotto"] ?>
                        </h3>
                        <p>Quantità : <?php echo $cartProduct["quantita"] ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
            <section class="order-recap-total">
                <p>Prezzo totale: <?php echo $templateParams["cartTotalPrice"] ?> €</p>
            </section>
        <?php else: ?>
            <section class="order-recap-header">
                <h2>Effettua il login per effettuare l'ordine</h2>
            </section>
        <?php endif; ?>
    </section>
    <?php if (isset($templateParams["cartProducts"])): ?>
        <section class="order-form-sec">
            <h2>Indirizzo di spedizione</h2>
            <form>
                <label for="addr-via">Via</label><br>
                <input type="text" id="addr-via" name="addr-via" required/>
                <label for="addr-citta">Città</label><br>
                <input type="text" id="addr-citta" name="addr-citta"  required/>
                <label for="addr-cap">Cap</label><br>
                <input type="text" id="addr-cap" name="addr-cap" maxlength="5" pattern="[0-9]{5}" required />
                <label for="addr-nazione">Nazione</label><br>
                <input type="text" id="addr-nazione" name="addr-nazione" />
                
            </form>
        </section>
        <section class="order-form-sec">
            <h2>Metodo di pagamento</h2>
        </section>
    <?php endif; ?>
</main>