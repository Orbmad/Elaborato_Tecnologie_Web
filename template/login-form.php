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
                    <input type="submit" name="submit" value="Accedi" />
                </li>
            </ul>
        </form>
        <button onclick="goToSignUpForm()">Iscriviti</button>
    </section>
        
    <section class="signup hidden">
        <form action="#" method="POST">
            <h1>Sign up</h1>
            <?php if(isset($templateParams["erroreSignup"])): ?>
                <p><?php echo $templateParams["erroreSignup"]; ?></p>
            <?php endif; ?>
            <ul>
                <li>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" />
                </li>
                <li>
                    <label for="cognome">Cognome:</label>
                    <input type="text" id="cognome" name="cognome" />
                </li>
                <li>
                    <label for="signEmail">Email:</label>
                    <input type="text" id="signEmail" name="signEmail" />
                </li>
                <li>
                    <label for="signPassword">Password:</label>
                    <input type="password" id="signPassword" name="signPassword" />
                </li>
                <li>
                    <label for="confermaPassword">Conferma password:</label>
                    <input type="password" id="confermaPassword" name="confermaPassword" />
                </li>
                <li>
                    <input type="submit" name="submitSignup" value="Conferma Iscrizione" />
                </li>
            </ul>
        </form>
    </section>
</main>