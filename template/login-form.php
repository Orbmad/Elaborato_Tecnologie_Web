<main class="login-form">
    <section class="login <?php if(isset($_SESSION["erroresignup"])) { echo "hidden"; }?>">
        <form action="./utils/api-login.php" method="POST">
            <h1>Login</h1>
            <?php if(isset($_SESSION["errorelogin"])): ?>
                <p><?php echo $_SESSION["errorelogin"]; ?></p>
            <?php endif; ?>
            <?php if(isset($_SESSION["msg"])): ?>
                <p><?php echo $_SESSION["msg"]; ?></p>
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
                    <button onclick="goToSignUpForm()" type="button">Iscriviti</button>
                    <input type="submit" name="submit" value="Accedi" />
                </li>
            </ul>
        </form>
    </section>
        
    <section class="signup <?php if(!isset($_SESSION["erroresignup"])) { echo "hidden"; }?>">
        <form action="./utils/api-signup.php" method="POST">

            <h1>Sign up</h1>

            <?php if(isset($_SESSION["erroresignup"])): ?>
                <p><?php echo $_SESSION["erroresignup"]; ?></p>
            <?php endif; ?>
            <ul>
                <li>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" <?php if(isset($_GET["ph_nome"])) { echo "value=" . $_GET["ph_nome"]; } ?> />
                </li>
                <li>
                    <label for="cognome">Cognome:</label>
                    <input type="text" id="cognome" name="cognome" <?php if(isset($_GET["ph_cognome"])) { echo "value=" . $_GET["ph_cognome"]; } ?> />
                </li>
                <li>
                    <label for="signEmail">Email:</label>
                    <input type="text" id="signEmail" name="signEmail" <?php if(isset($_GET["ph_email"])) { echo "value=" . $_GET["ph_email"]; } ?> />
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
                    <a href="login.php?back=ok">Indietro</a>
                    <input type="submit" name="submitSignup" value="Conferma Iscrizione" />
                </li>
            </ul>
        </form>
    </section>
</main>