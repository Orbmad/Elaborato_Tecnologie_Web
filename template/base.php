<!DOCTYPE html>
<html lang="it">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<body>
<!--Temporaneo check di login-->
<?php if (isset($_SESSION["email"])) {var_dump($_SESSION["email"]); }?>
    <header>
        <a href="./index.php"><h1>Plantatio</h1>
        </a><ul>
            <li class="user_icon">
                <a href="<?php if(!empty($_SESSION['email'])){echo '#';} else{ echo './login.php';} ?>"><img class="user_icon" src=".\img\User-Icon.png" alt="user-icon"/><img
                        src="img/cerchio.png" alt="notifiche" />
<!--Inserire numero di notifiche dell'utente-->
                    <p>1</p>
                </a>
                <ul id="submenu_user">
                    <li><a href="#">Esci</a></li>
                    <li><a href="#">Lista dei desideri</a></li>
                    <li><a href="#">Notifiche</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php if(!empty($_SESSION['email'])){echo '#';} else{ echo './login.php';} ?>"><img src=".\img\Cart-Icon.png" alt="cart-icon" /></a>
            </li>
        </ul>
    </header>

    <nav class="main-nav closed-nav">
        <form action="search.php" method="GET">
            <label for="fastSearch">Ricerca rapida</label>
            <section class="search-text">
                <input type="text" id="fastSearch" name="fastSearch" placeholder="Cerca la tua pianta..." oninput="showSuggestions()" value="<?php if(isset($templateParams["searchedWord"])){echo($templateParams["searchedWord"]);}?>"/>
                <ul class="suggestions not-showing"></ul>
            </section>
            <img class="searchbar-icon cancel-button" src="upload/cancel-icon.png" alt="Reset search button"
                onclick="resetText('fastsearch')" />
            <input class="searchbar-icon search-button" type="image" src="upload/search-icon.png" alt="Submit search">
        </form>

        <ul class="categories">
            <?php foreach ($templateParams["categorie"] as $categoria): ?>
                <li>
                    <button class="category-button" onclick='openSubcategories("<?php echo replaceSpacesWithHyphens($categoria["nome_categoria"]); ?>")' type="button"><?php echo $categoria["nome_categoria"]; ?>
                        <img class="toggleArrow side <?php echo replaceSpacesWithHyphens($categoria["nome_categoria"]); ?>" src="upload/toggleArrow-side.png" alt="Toggle arrow open" />
                        <img class="toggleArrow down hidden <?php echo replaceSpacesWithHyphens($categoria["nome_categoria"]); ?>" src="upload/toggleArrow-down.png" alt="Toggle arrow open" />
                    </button>
                    <ul class="subcategories <?php echo replaceSpacesWithHyphens($categoria["nome_categoria"]); ?>">
                        <li>
                            <button class="subcategory-button" onclick="window.location.href='search.php?categoriaSelezionata=<?php echo $categoria['nome_categoria']; ?>'" type="button">Vedi tutto</button>
                        </li>
                        <?php foreach ($categoria["sottocategorie"] as $sottocategoria): ?>
                            <li>
                                <button class="subcategory-button" onclick="window.location.href='search.php?sottocategoriaSelezionata=<?php echo $sottocategoria['nome_sottocategoria']; ?>'" type="button"><?php echo $sottocategoria["nome_sottocategoria"]; ?></button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>


        <!--MENU ICON-->
        <button class="menu-icon" onclick="mobileToggleMenu()" type="button">
            <img class="open-icon" src="upload/menu-icon.png" alt="Menu icon">
            <img class="close-icon" src="upload/close-menu-icon.png" alt="Close menu" />
        </button>

    </nav>
    <?php
    if (isset($templateParams["asideContent"])) {
        require($templateParams["asideContent"]);
    }
    ?>

    <?php
    if (isset($templateParams["mainContent"])) {
        require($templateParams["mainContent"]);
    }
    ?>   

    <footer>
        <section class="contacts">
            <p>Contatti</p>
            <ul>
                <li>
                    <img src="./upload/email.png" alt="email icon">
                    <span>plantatio@gmail.com</span>
                </li>
                <li>
                    <img src="./upload/facebook.png" alt="facebook icon">
                    <span>Facebook</span>
                </li>
                <li>
                    <img src="./upload/instagram.png" alt="instagram icon">
                    <span>Instagram</span>
                </li>
            </ul>
        </section>

        <section class="credits">
            <p>Crediti</p>
            <ul>
                <li>
                    <a href="https://www.flaticon.com/free-icons/menu-burger" title="menu-burger icons">Menu-burger icons created by
                        O.moonstd - Flaticon</a>
                </li>
                <li>
                    <a href="https://www.flaticon.com/free-icons/search" title="search icons">Search icons created by Taufik -
                        Flaticon</a>
                </li>
                <li>
                    <a href="https://www.flaticon.com/free-icons/close" title="close icons">Close icons created by Pixel perfect -
                        Flaticon</a>
                </li>
                <li>
                    <a href="https://www.flaticon.com/free-icons/next" title="next icons">Next icons created by deemakdaksina -
                        Flaticon</a>
                </li>
                <li>
                    <a href="https://www.flaticon.com/free-icons/arrow" title="arrow icons">Arrow icons created by Freepik - Flaticon</a>
                </li>
                <li>
                    <a href="https://www.flaticon.com/free-icons/left-arrow" title="left arrow icons">Left arrow icons created by IYAHICON - Flaticon</a>
                </li>
            </ul>
        </section>

        <!-- <a href="https://www.flaticon.com/free-icons/plus" title="plus icons">Plus icons created by srip - Flaticon</a>
         <a href="https://www.flaticon.com/free-icons/mathematics" title="mathematics icons">Mathematics icons created by Smashicons - Flaticon</a>
        <a href="https://www.flaticon.com/free-icons/delete" title="delete icons">Delete icons created by Freepik - Flaticon</a>-->

    </footer>
    <!-Inserimento javascript->
        <?php
        if (isset($templateParams["js"])):
            foreach ($templateParams["js"] as $script):
        ?>
                <script src="<?php echo $script; ?>"></script>
        <?php
            endforeach;
        endif;
        ?>
</body>

</html>