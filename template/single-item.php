<main class="single-item">
    <?php if(count($templateParams["prodotto"])==0): ?>
        <article><p>Prodotto non presente</p></article>
    <?php 
        else:
            $prodotto = $templateParams["prodotto"][0];
        ?>
        <article>
        <header>
            <img src="upload/<?php echo $prodotto["nome_prodotto"] ?>.jpg" alt=""/><section>
                <h2><?php echo $prodotto["nome_prodotto"] ?></h2>
                <h3><?php echo $prodotto["prezzo"] ?>$
                </h3><div class="star-value">
                    <?php for($i = 1; $i <= $prodotto["voto"]; $i++): ?>
                            <img src="upload/full_star.png" alt=""/>
                            <?php if($prodotto["voto"] - $i == 0.5): break;?>
                            <?php endif; ?>
                        <?php endfor;?>
                        <?php if($prodotto["voto"] == 0.5 || $prodotto["voto"] == 1.5
                        || $prodotto["voto"] == 2.5 || $prodotto["voto"] == 3.5
                        || $prodotto["voto"] == 4.5): ?>
                            <img src="upload/half_star.png" alt=""/>
                        <?php endif; ?>
                        <?php for($i = $prodotto["voto"] + 1; $i <= 5; $i++ ): ?>
                            <img src="upload/empty_star.png" alt=""/>
                        <?php endfor; ?>
                    </div><h3><?php echo $prodotto["voto"]?>/5</h3>
                <div class="wrapper">
                    <span class="minus" onclick="reduceQuantity()">-</span><span class="number">01</span><span class="plus" onclick="addQuantity(<?php echo $prodotto["stock"]?>)">+</span>
                </div><button type="button">Aggiungi al carrello</button>
            </section>
        </header>
        <!--Il bottone QUANTITA' deve passare id_prodotto e quantità per mettere nel carrello-->
        <section>
            <h3>Descrizione</h3>
            <p><?php echo $prodotto["descrizione"] ?></p>
            <table>
                <caption>Caratteristiche specifiche della pianta</caption>
        <!--caratteristiche della singola pianta-->
                <tr>
                    <th>Categoria</th>
                    <td><a href="#"><?php echo $prodotto["id_sottocategoria"]?></a></td>
                </tr>
                <tr>
                    <th>Nome volgare</th>
                    <td><?php echo $prodotto["nome_volgare"]?></td>
                </tr>
                <tr>
                    <th>Nome scientifico</th>
                    <td><?php echo $prodotto["nome_scientifico"]?></td>
                </tr>
                <tr>
                    <th>Famiglia</th>
                    <td><?php echo $prodotto["famiglia"]?></td>
                </tr>
                <tr>
                    <th>Genere</th>
                    <td><?php echo $prodotto["genere"]?></td>
                </tr>
                <tr>
                    <th>Specie</th>
                    <td><?php echo $prodotto["specie"]?></td>
                </tr>
                <tr>
                    <th>Dimensioni</th>
                    <td><?php echo $prodotto["dimensioni"]?></td>
                </tr>
                <tr>
                    <th>Tipologia foglia</th>
                    <td><?php echo $prodotto["tipologia_foglia"]?></td>
                </tr>
                <tr>
                    <th>Colore foglia</th>
                    <td><?php echo $prodotto["colore_foglia"]?></td>
                </tr>
            </table>
        </section>
    </article>
    <section>
        <h2>L'opinione dei planters!</h2>
        <?php foreach($templateParams["recensioni_prodotto"] as $rec):?>
            <article>
            <h3><?php echo $rec["nome"] ?></h3><div class="star-value-user">
                    <?php for($i = 1; $i <= $rec["voto"]; $i++): ?>
                            <img src="upload/full_star.png" alt=""/>
                            <?php if($rec["voto"] - $i == 0.5): break;?>
                            <?php endif; ?>
                        <?php endfor;?>
                        <?php if($rec["voto"] == 0.5 || $rec["voto"] == 1.5
                        || $rec["voto"] == 2.5 || $rec["voto"] == 3.5
                        || $rec["voto"] == 4.5): ?>
                            <img src="upload/half_star.png" alt=""/>
                        <?php endif; ?>
                        <?php for($i = $rec["voto"] + 1; $i <= 5; $i++ ): ?>
                            <img src="upload/empty_star.png" alt=""/>
                        <?php endfor; ?>
                    </div><h3><?php echo $rec["voto"]?>/5</h3>
            <h4><?php echo $rec["dataRec"] ?></h4>
            <p><?php echo $rec["commento"] ?></p>
            </article>
        <?php endforeach; ?>
    </section>
    
<?php endif; ?>
</main>