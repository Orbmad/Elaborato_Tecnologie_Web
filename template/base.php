<!DOCTYPE html>
<html lang="it">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $templateParams["titolo"]; ?></title>
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
    </head>
    <body>
        <header>
            <h1>Plantatio</h1>
        </header>
        <nav>
            <form action="#" method="GET">
                <label for="fastsearch">Ricerca rapida</label>
                    <input type="text" id="fastsearch" placeholder="Cerca la tua pianta.."/>
                    <input type="image" src="upload/cancel-icon.png" alt="Reset">
                    <input type="image" src="upload/search-icon.png" alt="Submit">
            </form>

            <img class="menu-icon" src="upload/menu-icon.png" alt="Menu icon">
        </nav>
        <main>

        </main>
        <footer>
            <a href="https://www.flaticon.com/free-icons/menu-burger" title="menu-burger icons">Menu-burger icons created by O.moonstd - Flaticon</a>
        </footer>
    </body>
</html>