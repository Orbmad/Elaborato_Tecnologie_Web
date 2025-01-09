<?php

    if (!(session_status() === PHP_SESSION_NONE)) {
        $_SESSION = [];
        session_destroy();
    }

    header("Location: index.php");
    exit;
?>