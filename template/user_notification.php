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
                        </h3><img class="<?php if(notificationNotRead($notifica['messaggio'], $notifica['dataRec'], $notifica['id_notifica'], $dbh)){echo 'show';}else{echo 'hidden';}?>" src="./img/cerchio-marroncino.png" alt="notification to read"/>
                        <p><?php echo $notifica['messaggio'] ?></p>
                        <button onclick="modificaNotifica('<?php echo $notifica['messaggio'] ?>', '<?php echo numberOfMessagesNotRead($dbh) ?>', '<?php echo $notifica['id_notifica']?>')">Leggi</button>
                    </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>