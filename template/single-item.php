<main class="single-item">
    <?php if (count($templateParams["prodotto"]) == 0): ?>
        <article>
            <p>Prodotto non presente</p>
        </article>
    <?php
    else:
        $prodotto = $templateParams["prodotto"][0];
    ?>
        <article>
            <header>
                <img src="upload/prodotti/<?php echo getSrc($prodotto["nome_prodotto"]) ?>.jpg" alt="" />
                <section>
                    <h2><?php echo $prodotto["nome_prodotto"] ?></h2>
                    <h3 class='price'><?php echo $prodotto["prezzo"] ?>€
                    </h3>
                    <div class="star-value">
                        <?php for ($i = 1; $i <= $prodotto["voto"]; $i++): ?>
                            <span class="fa fa-star checked"></span>
                        <?php endfor; ?>
                        <?php for ($i = $prodotto["voto"] + 1; $i <= 5; $i++): ?>
                            <span class="fa fa-star"></span>
                        <?php endfor; ?>
                    </div>

                    <h3><?php echo $prodotto["voto"] ?>/5</h3>

                    <?php if ($prodotto['stock'] > 0): ?>
                        <div class="wrapper">
                            <span class="minus" onclick="reduceQuantity()">-</span>
                            <span class="number">01</span>
                            <span class="plus" onclick="addQuantity(<?php echo $prodotto['stock'] ?>)">+</span>
                        </div>

                        <button type="button" <?php if (isUserLoggedIn()) : ?>
                            onclick="addToCart('<?php echo $prodotto['nome_prodotto'] ?>')"
                            <?php else: ?> onclick="showErrorMessage()"
                            <?php endif; ?>>Aggiungi al carrello
                        </button>
                        <span class="hidden">Operazione non disponibile, è necessario essere loggati</span>

                    <?php else: ?>
                        <span class="out_of_stock">La pianta non è al momento disponibile</span>
                    <?php endif; ?>

                </section>
            </header>

            <!-- SEZIONE VISIBILE SOLO ALL'ADMIN -->
            <?php if (isAdminLoggedIn()): ?>
                <section class="admin-product">
                    <h1>Gestione prodotto</h1>

                    <?php if (isset($_SESSION["errore"])): ?>
                        <p><?php echo $_SESSION["errore"]; ?></p>
                    <?php endif; ?>
                    <?php if (isset($_SESSION["msg"])): ?>
                        <p><?php echo $_SESSION["msg"]; ?></p>
                    <?php endif; ?>

                    <form action="../utils/api-admin.php" method="POST">
                        <input type="hidden" name="queryType" value="gestione-prodotto" />
                        <input type="hidden" name="id" value="<?php echo $prodotto["nome_prodotto"] ?>" />
                        <ul>
                            <li>
                                <button type="button" onclick=updateProduct() >Modifica prodotto</button>
                            </li>
                            <li>
                                <button type="submit" name="elimina" value="<?php echo $prodotto["nome_prodotto"] ?>">Cancella prodotto</button>
                            </li>
                        </ul>
                    </form>

                    <section class="hidden">
                        <form action="../utils/api-admin.php" method="POST">
                            <input type="hidden" name="queryType" value="gestione-prodotto" />
                            <input type="hidden" name="id" value="<?php echo $prodotto["nome_prodotto"] ?>" />

                            <ul>
                                <li>
                                    <label for="nome_prodotto">Nome prodotto:</label>
                                    <input type="text" id="nome_prodotto" name="nome_prodotto" value="<?php echo $prodotto["nome_prodotto"] ?>" required />
                                </li>
                                <li>
                                    <label for="prezzo">Prezzo:</label>
                                    <input type="number" id="prezzo" name="prezzo" value="<?php echo $prodotto["prezzo"] ?>" required/>
                                </li>
                                <li>
                                    <label for="nome_sottocategoria">Sottocategoria:</label>
                                    <input type="text" id="nome_sottocategoria" name="nome_sottocategoria" value="<?php echo $prodotto["id_sottocategoria"] ?>" required />
                                </li>
                                <li>
                                    <label for="stock">Stock:</label>
                                    <input type="text" id="stock" name="stock" value="<?php echo $prodotto["stock"] ?>" required />
                                </li>
                                <li>
                                    <label for="nome_volgare">Nome volgare:</label>
                                    <input type="text" id="nome_volgare" name="nome_volgare" value="<?php echo $prodotto["nome_volgare"] ?>" />
                                </li>
                                <li>
                                    <label for="nome_scientifico">Nome Scientifico:</label>
                                    <input type="text" id="nome_scientifico" name="nome_scientifico" value="<?php echo $prodotto["nome_scientifico"] ?>" />
                                </li>
                                <li>
                                    <label for="famiglia">Famiglia:</label>
                                    <input type="text" id="famiglia" name="famiglia" value="<?php echo $prodotto["famiglia"] ?>" />
                                </li>
                                <li>
                                    <label for="genere">Genere:</label>
                                    <input type="text" id="genere" name="genere" value="<?php echo $prodotto["genere"] ?>" />
                                </li>
                                <li>
                                    <label for="specie">Specie:</label>
                                    <input type="text" id="specie" name="specie" value="<?php echo $prodotto["specie"] ?>" />
                                </li>
                                <li>
                                    <label for="profumo">Profumo:</label>
                                    <input type="text" id="profumo" name="profumo" value="<?php echo $prodotto["profumo"] ?>" />
                                </li>
                                <li>
                                    <label for="tipologia_foglia">Tipologia foglia:</label>
                                    <input type="text" id="tipologia_foglia" name="tipologia_foglia" value="<?php echo $prodotto["tipologia_foglia"] ?>" />
                                </li>
                                <li>
                                    <label for="colore_foglia">Colore foglia:</label>
                                    <input type="text" id="colore_foglia" name="colore_foglia" value="<?php echo $prodotto["colore_foglia"] ?>" />
                                </li>
                                <li>
                                    <label for="dimensioni">Dimensioni</label>
                                    <input type="text" id="dimensioni" name="dimensioni" value="<?php echo $prodotto["dimensioni"] ?>" />
                                </li>
                                <li>
                                    <label for="descrizione">Descrizione:</label>
                                    <input type="text" id="descrizione" name="descrizione" value="<?php echo $prodotto["descrizione"] ?>" />
                                </li>
                                <li class="files">
                                    <!--Inserimento Immagine-->
                                    <section class="file-upload">
                                        <label for="fileInput-product">📁 Immagine prodotto</label>
                                        <input type="file" id="fileInput-product" name="immagine" accept="image/*" />
                                        <span class="file-name-product">Nessun file selezionato</span>
                                    </section>
                                </li>
                                <li>
                                    <input type="submit" name="modifica" value="Conferma" />
                                </li>
                            </ul>
                        </form>
                    </section>
                </section>
            <?php endif; ?>


            <!--Il bottone QUANTITA' deve passare id_prodotto e quantità per mettere nel carrello-->
            <section>
                <h3>Descrizione</h3>
                <p><?php echo $prodotto["descrizione"] ?></p>
                <table>
                    <caption>Caratteristiche specifiche della pianta</caption>
                    <tr>
                        <th>Dimensioni</th>
                        <td><?php echo $prodotto["dimensioni"] ?></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th>Categoria</th>
                        <td><a href="search.php?sottocategoriaSelezionata=<?php echo getSrc($prodotto["id_sottocategoria"]) ?>"><?php echo $prodotto["id_sottocategoria"] ?></a></td>
                    </tr>
                    <?php if(strcmp($prodotto["nome_volgare"], 'non specificato') != 0): ?>
                    <tr>
                        <th>Nome volgare</th>
                        <td><?php echo $prodotto["nome_volgare"] ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if(strcmp($prodotto["nome_scientifico"], 'non specificato') != 0): ?>
                    <tr>
                        <th>Nome scientifico</th>
                        <td><?php echo $prodotto["nome_scientifico"] ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if(strcmp($prodotto["famiglia"], 'non specificato') != 0): ?>
                    <tr>
                        <th>Famiglia</th>
                        <td><?php echo $prodotto["famiglia"] ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if(strcmp($prodotto["genere"], 'non specificato') != 0): ?>
                    <tr>
                        <th>Genere</th>
                        <td><?php echo $prodotto["genere"] ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if(strcmp($prodotto["specie"], 'non specificato') != 0): ?>
                    <tr>
                        <th>Specie</th>
                        <td><?php echo $prodotto["specie"] ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if(strcmp($prodotto["tipologia_foglia"], 'non specificato') != 0): ?>
                    <tr>
                        <th>Tipologia foglia</th>
                        <td><?php echo $prodotto["tipologia_foglia"] ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if(strcmp($prodotto["colore_foglia"], 'non specificato') != 0): ?>
                    <tr>
                        <th>Colore foglia</th>
                        <td><?php echo $prodotto["colore_foglia"] ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if(strcmp($prodotto["profumo"], 'non specificato') != 0): ?>
                    <tr>
                        <th>Profumo</th>
                        <td><?php echo $prodotto["profumo"] ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
            </section>
        </article>

        <section>
            <h2>L&apos;opinione dei planters!</h2>
            <?php if(count($templateParams["recensioni_prodotto"]) == 0): ?>
                <p>Non ci sono recensioni per questo prodotto</p>
            <?php else: ?>
                <?php foreach ($templateParams["recensioni_prodotto"] as $rec): ?>
                    <article>
                        <h3><?php echo $rec["nome"] ?></h3>
                        <div class="star-value-user">
                            <?php for ($i = 1; $i <= $rec["voto"]; $i++): ?>
                                <span class="fa fa-star checked"></span>
                            <?php endfor; ?>
                            <?php for ($i = $rec["voto"] + 1; $i <= 5; $i++): ?>
                                <span class="fa fa-star"></span>
                            <?php endfor; ?>
                        </div>
                        <h3><?php echo $rec["voto"] ?>/5</h3>
                        <h4><?php echo $rec["dataRec"] ?></h4>
                        <p><?php echo $rec["commento"] ?></p>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

    <?php endif; ?>
</main>