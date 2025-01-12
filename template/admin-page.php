<main class="admin-page">

    <section class="default">
        <h1>Gestione</h1>
        <?php if(isset($_SESSION["errore"])):?>
            <p><?php echo $_SESSION["errore"]; ?></p>
        <?php endif; ?>
        <?php if(isset($_SESSION["msg"])): ?>
            <p><?php echo $_SESSION["msg"]; ?></p>
        <?php endif; ?>

        <ul>
            <li>
                <button class="inserisci-prodotto" type="button">Inserisci prodotto</button>
            </li>
            <li>
                <button class="crea-gruppo" type="button">Crea gruppo</button>
            </li>
            <li>
                <button class="inserisci-in-gruppo" type="button">Inserisci in gruppo</button>
            </li>
            <li>
                <button class="rimuovi-da-gruppo" type="button">Rimuovi da gruppo</button>
            </li>
        </ul>
    </section>

    <section class="inserisci-prodotto hidden">
        <h1>Inserisci prodotto</h1>

        <form action="./utils/api-admin.php" method="POST">
            <input type="hidden" name="queryType" value="inserisciprodotto" required />
            <ul>
                <li>
                    <label for="nome_prodotto">Nome prodotto:</label>
                    <input type="text" id="nome_prodotto" name="nome_prodotto" required />
                </li>
                <li>
                    <label for="prezzo">Prezzo:</label>
                    <input type="text" id="prezzo" name="prezzo" required />
                </li>
                <li>
                    <label for="nome_sottocategoria">Sottocategoria:</label>
                    <input type="text" id="nome_sottocategoria" name="nome_sottocategoria" required />
                </li>
                <li>
                    <label for="stock">Stock:</label>
                    <input type="text" id="stock" name="stock" required />
                </li>
                <li>
                    <label for="nome_volgare">Nome volgare:</label>
                    <input type="text" id="nome_volgare" name="nome_volgare" required />
                </li>
                <li>
                    <label for="nome_scientifico">Nome Scientifico:</label>
                    <input type="text" id="nome_scientifico" name="nome_scientifico" required />
                </li>
                <li>
                    <label for="famiglia">Famiglia:</label>
                    <input type="text" id="famiglia" name="famiglia" required />
                </li>
                <li>
                    <label for="genere">Genere:</label>
                    <input type="text" id="genere" name="genere" required />
                </li>
                <li>
                    <label for="specie">Specie:</label>
                    <input type="text" id="specie" name="specie" required />
                </li>
                <li>
                    <label for="profumo">Profumo:</label>
                    <input type="text" id="profumo" name="profumo" required />
                </li>
                <li>
                    <label for="tipologia_foglia">Tipologia foglia:</label>
                    <input type="text" id="tipologia_foglia" name="tipologia_foglia" required />
                </li>
                <li>
                    <label for="colore_foglia">Colore foglia:</label>
                    <input type="text" id="colore_foglia" name="colore_foglia" required />
                </li>
                <li>
                    <label for="dimensioni">Dimensioni</label>
                    <input type="text" id="dimensioni" name="dimensioni" required />
                </li>
                <li>
                    <label for="descrizione">Descrizione:</label>
                    <input type="text" id="descrizione" name="descrizione" required />
                </li>
                <li>
                    <!--Inserimento Immagine-->
                    <section class="file-upload">
                        <label for="fileInput">📁 Immagine prodotto</label>
                        <input type="file" id="fileInput" name="immagine" accept="image/*" required />
                        <span class="file-name">Nessun file selezionato</span>
                    </section>
                </li>
                <li>
                    <input type="submit" name="submit" value="Conferma"/>
                </li>
            </ul>
        </form>
    </section>

    <section class="crea-gruppo hidden">
        <h1>Crea gruppo</h1>
        <form action="./utils/api-admin.php" method="POST">
            <input type="hidden" name="queryType" value="creagruppo" />
            <ul>
                <li>
                    <label for="nomeGruppo">Nome gruppo:</label>
                    <input type="text" id="nomeGruppo" name="nomeGruppo" required />
                </li>
                <li>
                    <label for="descrizioneGruppo">Descrizione gruppo:</label>
                    <input type="text" id="descrizioneGruppo" name="descrizioneGruppo" required />
                </li>
                <li>
                    <!--Inserimento Immagine-->
                    <section class="file-upload">
                        <label for="fileInput">📁 Immagine gruppo</label>
                        <input type="file" id="fileInput" name="immagine" accept="image/*" required />
                        <span class="file-name">Nessun file selezionato</span>
                    </section>
                </li>
                <li>
                    <input type="submit" name="submit" value="Conferma"/>
                </li>
            </ul>
        </form>
    </section>

    <section class="inserisci-in-gruppo hidden">
        <h1>Inserisci in gruppo</h1>
        <form action="./utils/api-admin.php" method="POST">
            <input type="hidden" name="queryType" value="inserisciingruppo" />
            <ul>
                <li>
                    <label for="nome_prodotto">Nome gruppo:</label>
                    <input type="text" id="nomeGruppo" name="nomeGruppo" required />
                </li>
                <li>
                    <label for="nomeGruppo">Nome prodotto:</label>
                    <input type="text" id="nomeProdotto" name="nomeProdotto" required />
                </li>
                <li>
                    <input type="submit" name="submit" value="Conferma"/>
                </li>
            </ul>
        </form>
    </section>

    <section class="rimuovi-da-gruppo hidden">
        <h1>Inserisci in gruppo</h1>
        <form action="./utils/api-admin.php" method="POST">
        <input type="hidden" name="queryType" value="rimuovidagruppo" />
            <ul>
                <li>
                    <label for="nome_prodotto">Nome prodotto:</label>
                    <input type="text" id="nomeProdotto" name="nomeProdotto" required />
                </li>
                <li>
                    <label for="nomeGruppo">Nome gruppo:</label>
                    <input type="text" id="nomeGruppo" name="nomeGruppo" required />
                </li>
                <li>
                    <input type="submit" name="submit" value="Conferma"/>
                </li>
            </ul>
        </form>
    </section>

</main>
