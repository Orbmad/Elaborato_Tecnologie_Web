<main class="notification">
<section class="cart-products">
        <section class="notification-header">
            <h2>
                Le tue notifiche
            </h2>
        </section>
        <ul>
            <?php foreach ($templateParams["notifiche"] as $notifica): ?>
                <li>
                        <h3>
                            <?php echo $notifica['dataRec'] ?>
                        </h3><img class="<?php if(notificationNotRead($notifica['messaggio'], $notifica['dataRec'], $dbh)){echo 'show';}else{echo 'hidden';}?>" src="./img/cerchio-marrone.png" alt="notification to read"/>
                        <p><?php echo $notifica['messaggio'] ?></p>
                        <button onclick="modificaNotifica('<?php echo $notifica['messaggio'] ?>', '<?php echo numberOfMessagesNotRead($dbh) ?>')">Leggi</button>
                    </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>