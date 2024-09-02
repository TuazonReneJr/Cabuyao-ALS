<?php
    // session_manager.php

    if (session_status() === PHP_SESSION_NONE) {
        // Session has not been started yet
        session_start();
    }

    $session_lifetime = 3600; // 1 hour

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $session_lifetime) {
        session_unset();
        session_destroy();
    }

    $_SESSION['LAST_ACTIVITY'] = time();

