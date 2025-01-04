<!DOCTYPE html>
<html lang="it">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.75" />
        <title><?php echo $templateParams["titolo"]; ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet"> <!-Inserimento font->
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
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
    </head>
    <body>
        <header>
            <h1>Plantatio
            </h1><ul>
                <li class="user_icon">
                    <a href="#"><img class="user_icon" src=".\img\Icona-Utente.png" alt="user-icon"/><img src="img/cerchio.png" alt="notifiche"/><p>1</p></a>
                    <ul id="submenu_user">
                        <li><a href="#">Esci</a></li>
                        <li><a href="#">Lista dei desideri</a></li>
                        <li><a href="#">Notifiche</a></li>
                    </ul>
                </li><li>
                    <a href="#"><img src=".\img\Icona-Carrello.jpg" alt="cart-icon"/></a>
                </li>
            </ul>
        </header>
        
        <nav class="main-nav closed-nav">
            <form action="search.php" method="GET">
                <label for="fastsearch">Ricerca rapida</label>
                <section class="search-text">
                    <input type="text" id="fastsearch" placeholder="Cerca la tua pianta..." oninput="showSuggestions()"/>
                    <ul class="suggestions not-showing"></ul>
                </section>
                <img class="searchbar-icon cancel-button" src="upload/cancel-icon.png" alt="Reset search button" onclick="resetText('fastsearch')"/>
                <input class="searchbar-icon search-button" type="image" src="upload/search-icon.png" alt="Submit search">
            </form>

            <ul class="categories">
                <?php foreach($categories as $categoria): ?>
                    <li>
                        <button class="category-button" onclick=""><?php echo $categoria["nome_categoria"]; ?></button>
                        <ul class="subcategories">
                            <?php foreach($categoria["sottocategorie"] as $sottocategoria): ?>
                                <li>
                                <!--onclick deve contenere una funzione che utilizza il nome della sottocategoria-->
                                    <button class="subcategory-button" onclick=""><?php echo $sottocategoria["nome_sottocategoria"]; ?></button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <button class="menu-icon">
                <img src="upload/menu-icon.png" alt="Menu icon">
            </button>        

        </nav>

        <main>
        <?php
        if(isset($templateParams["slideShow"])){
            require($templateParams["slideShow"]);
        }
        ?>
        </main>

        <footer>
            <a href="https://www.flaticon.com/free-icons/menu-burger" title="menu-burger icons">Menu-burger icons created by O.moonstd - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/search" title="search icons">Search icons created by Taufik - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/close" title="close icons">Close icons created by Pixel perfect - Flaticon</a>
            <a href="https://www.flaticon.com/free-icons/next" title="next icons">Next icons created by deemakdaksina - Flaticon</a>
        </footer>
    </body>
</html>