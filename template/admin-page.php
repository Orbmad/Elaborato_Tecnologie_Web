<main class="admin-page">

    <section class="default">
        <h1>Gestione</h1>
        <?php if(isset($_SESSION["errore"])):?>
            <p><?php echo $_SESSION["errore"]; ?></p>
        <?php endif; ?>

        <ul>
            <li>
                <button type="button">Inserisci prodotto</button>
            </li>
            <li>
                <button type="button">Crea gruppo</button>
            </li>
            <li>
                <button type="button">Inserisci in gruppo</button>
            </li>
            <li>
                <button type="button">Rimuovi da gruppo</button>
            </li>
        </ul>
    </section>

    <section class="inserisci-prodotto hidden">
        <h1>Inserisci prodotto</h1>

        <form action="#" method="$_GET">
            <ul>
                <li>
                    <label for="nome_prodotto"></label>
                    <input type="text" id="nome_prodotto" name="nome_prodotto" />
                </li>
                <li>
                    <label for="prezzo"></label>
                    <input type="text" id="prezzo" name="prezzo" />
                </li>
                <li>
                    <!--Considera menu a tendina-->
                    <label for="nome_sottocategoria"></label>
                    <input type="text" id="nome_sottocategoria" name="nome_sottocategoria" />
                </li>
                <li>
                    <label for="stock"></label>
                    <input type="text" id="stock" name="stock" />
                </li>
                <li>
                    <label for="nome_volgare"></label>
                    <input type="text" id="nome_volgare" name="nome_volgare" />
                </li>
                <li>
                    <label for="nome_scientifico"></label>
                    <input type="text" id="nome_scientifico" name="nome_scientifico" />
                </li>
                <li>
                    <label for="famiglia"></label>
                    <input type="text" id="famiglia" name="famiglia" />
                </li>
                <li>
                    <label for="famiglia"></label>
                    <input type="text" id="famiglia" name="famiglia" />
                </li>
                <li>
                    <label for="genere"></label>
                    <input type="text" id="genere" name="genere" />
                </li>
                <li>
                    <label for="specie"></label>
                    <input type="text" id="specie" name="specie" />
                </li>
                <li>
                    <label for="profumo"></label>
                    <input type="text" id="profumo" name="profumo" />
                </li>
                <li>
                    <label for="tipologia_foglia"></label>
                    <input type="text" id="tipologia_foglia" name="tipologia_foglia" />
                </li>
                <li>
                    <label for="colore_foglia"></label>
                    <input type="text" id="colore_foglia" name="colore_foglia" />
                </li>
                <li>
                    <label for="dimensioni"></label>
                    <input type="text" id="dimensioni" name="dimensioni" />
                </li>
                <li>
                    <label for="descrizione"></label>
                    <input type="text" id="descrizione" name="descrizione" />
                </li>
                <li>
                    <input type="submit" name="submit" value="Conferma"/>
                </li>
            </ul>
        </form>
        <!--Inserimento Immagine-->
    </section>

    <section class="crea-gruppo hidden">
        <h1>Crea gruppo</h1>
        <form action="#" method="$_GET">
            <ul>
                <li>
                    <label for="nomeGruppo"></label>
                    <input type="text" id="nomeGruppo" name="nomeGruppo" />
                </li>
                <li>
                    <label for="descrizioneGruppo"></label>
                    <input type="text" id="descrizioneGruppo" name="descrizioneGruppo" />
                </li>
                <li>
                    <input type="submit" name="submit" value="Conferma"/>
                </li>
            </ul>
        </form>
    </section>

    <section class="inserisci-in-gruppo hidden">
        <h1>Inserisci in gruppo</h1>
        <form action="#" method="$_GET">
            <ul>
                <li>
                    <label for="nome_prodotto"></label>
                    <input type="text" id="nome_prodotto" name="nomeGruppo" />
                </li>
                <li>
                    <label for="nomeGruppo"></label>
                    <input type="text" id="nomeGruppo" name="nomeGruppo" />
                </li>
                <li>
                    <input type="submit" name="submit" value="Conferma"/>
                </li>
            </ul>
        </form>
    </section>

    <section class="rimuovi-da-gruppo hidden">
        <h1>Inserisci in gruppo</h1>
        <form action="#" method="$_GET">
            <ul>
                <li>
                    <label for="nome_prodotto"></label>
                    <input type="text" id="nome_prodotto" name="nomeGruppo" />
                </li>
                <li>
                    <label for="nomeGruppo"></label>
                    <input type="text" id="nomeGruppo" name="nomeGruppo" />
                </li>
                <li>
                    <input type="submit" name="submit" value="Conferma"/>
                </li>
            </ul>
        </form>
    </section>

</main>
