<main class="main-order-recap">
        <section class="order-recap-header">
            <h2>
                Ordini completati
            </h2>
        </section>
        <?php if(count($templateParams["orders"]) == 0): ?>
            <p>Non sono presenti ordini</p>
        <?php else: ?>
            <?php $cont = 1 ?>
            <?php foreach($templateParams["orders"] as $order): ?>
                <section class="order-item">
                    <header>
                        <ul>
                            <li><p>DATA ORDINE:</p></li>
                            <li><p><?php echo $order['dataOrdine'] ?></p></li>
                        </ul><ul>
                            <li><p>STATO:</p></li>
                            <li><p><?php echo $order['stato_ordine'] ?></p></li>
                        </ul><ul>
                            <li><p>TOTALE:</p></li>
                            <li><p><?php echo $order['totale'] ?>€</p></li>
                        </ul>
                    </header>
                    <p>INDIRIZZO DI SPEDIZIONE: via <?php echo $order['via'].", ".$order['citta']." ".$order['cap']." (".$order['provincia']."), ".$order['nazione'] ?></p>
                    
                    <?php foreach (getProductsOfAOrder($order['id_ordine'], $dbh) as $item): ?>
                        <img onclick="window.location.href='product.php?idP=<?php echo getSrc($item['nome_prodotto']) ?>'"
                            src="./upload/prodotti/<?php echo getSrc($item['nome_prodotto']) ?>.jpg"
                            alt="Immagine del prodotto" /><section class='info-item-in-order'>
                            <p class="name"><?php echo $item['nome_prodotto'] ?></p>
                            <p>Quantità: <?php echo $item['quantita'] ?></p>
                            <p>Prezzo unitario: <?php echo $item['prezzo_unitario'] ?></p>
                                <button class="<?php if(strcmp($order['stato_ordine'], 'Consegnato') == 0 && !hasUserLeftAReviewForProduct($dbh, $item['nome_prodotto'])){echo "show";} else{echo "hidden";} ?>" type='button'>Lascia recensione</button>
                        </section>
                        <section class='hidden leave-review'>
                            <span>Voto: </span><span class="fa fa-star 1"></span>
                            <span class="fa fa-star 2"></span>
                            <span class="fa fa-star 3"></span>
                            <span class="fa fa-star 4"></span>
                            <span class="fa fa-star 5"></span>
                            <label for="rev<?php echo $cont?>">Recensione: </label>
                            <textarea rows="7" cols="45" name="review" id="rev<?php echo $cont?>"></textarea>
                            <button type="button" class="<?php echo $cont?>">Invia</button>
                            <p class="hidden">Non è possibile lasciare una recensione con voto pari a 0</p>
                            <?php $cont++ ?>
                        </section>
                    <?php endforeach; ?>
                </section>
                <?php endforeach; ?>
                
            <?php endif; ?>
</main>