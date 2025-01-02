<?php if(count($templateParams["prodotto"])==0): ?>
    <article>
        Prodotto non presente
    </article>
    <?php 
        else:
            $prodotto = $templateParams["prodotto"][0];
        ?>
<article>
    <header>
        <img src="utilitis/<?php echo $prodotto["nome_prodotto"] ?>.jpg" alt=""/>
        <h2><?php echo $prodotto["nome_prodotto"] ?></h2>
        <h3><?php echo $prodotto["prezzo"] ?></h3>
    </header>
    <!--stelline per prodotto-->
    <!--BOTTONE PER AUMENTARE QUANTITA'-->
    <div class="wrapper">
        <span class="minus" onclick="reduceQuantity()">-</span><span class="number">01</span><span class="plus" onclick="addQuantity($prodotto['stock'])">+</span>
    </div><button type="button">Aggiungi al carrello</button>
    <section>
        <h3>Descrizione</h3>
        <p><?php echo $prodotto["descrizione"] ?></p>
        <ul>
            <li><p>Codice:id_<?php echo $prodotto["id_prodotto"]?></p></li>
        <!--caratteristiche della singola pianta-->
            <li><p>Categoria: <a href="#"><?php echo $prodotto["categoria"]?></a></p></li>
        </ul>
    </section>
</article>
<h2>Lopinione dei planters!</h2>
<?php endif; ?>