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
                <h3><?php echo $prodotto["prezzo"] ?>$</h3>
                <div class="wrapper">
                    <span class="minus" onclick="reduceQuantity()">-</span><span class="number">01</span><span class="plus" onclick="addQuantity(<?php echo $prodotto["stock"]?>)">+</span>
                </div><button type="button">Aggiungi al carrello</button>
            </section>
        </header>
        <!--stelline per prodotto-->
        <!--BOTTONE PER AUMENTARE QUANTITA'-->
        <!--Il bottone deve passare id_prodotto e quantità per mettere nel carrello-->
        <section>
            <h3>Descrizione</h3>
            <p><?php echo $prodotto["descrizione"] ?></p>
            <ul>
        <!--caratteristiche della singola pianta-->
                <li><p>Categoria: <a href="#"><?php echo $prodotto["id_sottocategoria"]?></a></p></li>
            </ul>
        </section>
    </article>
    <h2>Lopinione dei planters!</h2>
<?php endif; ?>
</main>