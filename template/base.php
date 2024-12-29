<!DOCTYPE html>
<html lang="it">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $templateParams["titolo"]; ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet"> <!-Inserimento font->
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
    </head>
    <body>
        <header>
        <h1>Platatio
            </h1><ul>
            <!--Creazione di una lista per gestire con css il fatto che la lista si trova a dx della pagina-->
                <li  id="icon">
                    <a href="#"><img src=".\img\Icona-Utente.png" alt="user-icon"/></a>
                    <ul>
                        <li><a href="#">Esci</a></li>
                        <li><a href="#">Lista dei desideri</a></li>
                        <li><a href="#">Notifiche</a></li>
                    </ul>
                </li><li>
                    <a href="#"><img src=".\img\Icona-Carrello.jpg" alt="cart-icon"/></a>
                </li>
            </ul>
        </header>
        <nav class="closed-nav">
            <form action="#" method="GET">
                <label for="fastsearch">Ricerca rapida</label>
                    <input type="text" id="fastsearch" placeholder="Cerca la tua pianta.."/>
                    <img class="searchbar-icon cancel-button" src="upload/cancel-icon.png" alt="Reset search button" onclick="clearText(fastsearch)"/>
                    <input class="searchbar-icon search-button" type="image" src="upload/search-icon.png" alt="Submit search">
            </form>

            <ul class="categories">
                <?php foreach($templateParams["categorie"] as $categoria): ?>
                    <li>
                        <a href=# onclick=""><?php echo $categoria["nome_categoria"]; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <img class="menu-icon" src="upload/menu-icon.png" alt="Menu icon">
        </nav>
        <main>
            <section class="main-articles">
                <img src="upload/left-arrow-icon.png" class="left-arrow-icon"/>
                <img src="upload/right-arrow-icon.png" class="right-arrow-icon"/>
                <ul>
                    <li class="hidden">
                        <article>
                            <img src="upload/pianta.jpg" alt="Immagine dell'articolo"/>
                            <section class ="article-body">
                                <h3>PLANTUS FICUS</h3>
                                <p>Immagina di entrare in una stanza e sentire immediatamente un senso di calma e benessere. Le piante da interno non sono solo un semplice complemento d’arredo, ma un vero e proprio tocco di natura che trasforma ogni ambiente, rendendolo più accogliente, armonico e salutare.</p>
                                <footer>
                                <input type="button" value="SCOPRI ARTICOLO"></input>
                                </footer>
                            </section>
                        </article>
                    </li><li class="focused-article">
                        <article>
                            <img src="upload/pianta.jpg" alt="Immagine dell'articolo"/>
                            <section class ="article-body">
                                <h3>PLANTUS FICUS</h3>
                                <p>Immagina di entrare in una stanza e sentire immediatamente un senso di calma e benessere. Le piante da interno non sono solo un semplice complemento d’arredo, ma un vero e proprio tocco di natura che trasforma ogni ambiente, rendendolo più accogliente, armonico e salutare.</p>
                                <footer>
                                <input type="button" value="SCOPRI ARTICOLO"></input>
                                </footer>
                            </section>
                        </article>
                    </li><li class="hidden">
                        <article>
                            <img src="upload/pianta.jpg" alt="Immagine dell'articolo"/>
                            <section class ="article-body">
                                <h3>PLANTUS FICUS</h3>
                                <p>Immagina di entrare in una stanza e sentire immediatamente un senso di calma e benessere. Le piante da interno non sono solo un semplice complemento d’arredo, ma un vero e proprio tocco di natura che trasforma ogni ambiente, rendendolo più accogliente, armonico e salutare.</p>
                                <footer>
                                <input type="button" value="SCOPRI ARTICOLO"></input>
                                </footer>
                            </section>
                        </article>
                    </li>
                </ul>
            </section>
        </main>

        <footer>
            <a href="https://www.flaticon.com/free-icons/menu-burger" title="menu-burger icons">Menu-burger icons created by O.moonstd - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/search" title="search icons">Search icons created by Taufik - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/close" title="close icons">Close icons created by Pixel perfect - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/next" title="next icons">Next icons created by deemakdaksina - Flaticon</a>
        </footer>

        <!-Inserimento javascript->
        <?php
            if(isset($templateParams["js"])):
                foreach($templateParams["js"] as $script):
            ?>
                <script src="<?php echo $script; ?>"></script>
            <?php
                endforeach;
            endif;
        ?>
    </body>
</html>