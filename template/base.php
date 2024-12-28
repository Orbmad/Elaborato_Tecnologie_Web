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
            <h1>Plantatio</h1>
        </header>
        <nav class="closed-nav">
            <form action="#" method="GET">
                <label for="fastsearch">Ricerca rapida</label>
                    <input type="text" id="fastsearch" placeholder="Cerca la tua pianta.."/>
                    <input class="reset" type="image" src="upload/cancel-icon.png" alt="Reset">
                    <input class="submit" type="image" src="upload/search-icon.png" alt="Submit">
            </form>

            
            <img class="menu-icon" src="upload/menu-icon.png" alt="Menu icon">
        </nav>
        <main>

        </main>

        <footer>
            <a href="https://www.flaticon.com/free-icons/menu-burger" title="menu-burger icons">Menu-burger icons created by O.moonstd - Flaticon</a>
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