<?php
    /**
     * Restituisce la stringa passata dopo aver sostituito gli spazi con dei trattini.
     */
    function replaceSpacesWithHyphens($string) {
        $temp = $string;
        $newString = str_replace(' ', '-', $temp);
        return $newString;
    }

    /**
     * Register the user in the current session.
     */
    function registerLoggedUser($user){
        $_SESSION["email"] = $user["email"];
        $_SESSION["nome"] = $user["nome"];
        $_SESSION["cognome"] = $user["cognome"];
        $_SESSION["admin_flag"] = $user["admin_flag"];
    }

    /**
     * Returns true if the user is logged in the active session.
     */
    function isUserLoggedIn() {
        return !empty($_SESSION['email']);
    }

    /**
     * Returns true if the logged user is an admin.
     */
    function isAdminLoggedIn() {
        return (isUserLoggedIn() && $_SESSION["admin_flag"]);
    }

    /**
     * Returns true if the email is correct.
     */
    function checkEmail($email) {

        $email = trim($email);

        if (empty($email)) {
            return false;
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    function checkPassword($password) {
        // Controlla la lunghezza (minimo 8 caratteri)
        if (strlen($password) < 8) {
            return "La password deve contenere almeno 8 caratteri.";
        }
    
        // Controlla la presenza di almeno una lettera maiuscola
        if (!preg_match('/[A-Z]/', $password)) {
            return "La password deve contenere almeno una lettera maiuscola.";
        }
    
        // Controlla la presenza di almeno una lettera minuscola
        if (!preg_match('/[a-z]/', $password)) {
            return "La password deve contenere almeno una lettera minuscola.";
        }
    
        // Controlla la presenza di almeno un numero
        if (!preg_match('/[0-9]/', $password)) {
            return "La password deve contenere almeno un numero.";
        }
    
        // Controlla la presenza di almeno un carattere speciale
        if (!preg_match('/[\W_]/', $password)) {
            return "La password deve contenere almeno un carattere speciale (!@#$%^&*...).";
        }
    
        return true; // ✅ Password sicura
    }
?>