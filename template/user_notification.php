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
                        </h3>
                        <p><?php echo $notifica['commento'] ?></p>
                        <button onclick="modificaNotifica('<?php echo $notifica['commento'] ?>')">Leggi</button>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>