<main class="login-form">
    <section class="login">
        <form action="#" method="POST">
            <h1>Login</h1>
            <?php if(isset($templateParams["errorelogin"])): ?>
                <p><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>
            <ul>
                <li>
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" />
                </li>
                <li>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" />
                </li>
                <li>
                    <button>Iscriviti</button>
                    <input type="submit" name="submit" value="Accedi" />
                </li>
            </ul>
        </form>
    </section>

    <section class="signup">

    </section>
</main>