<?php
    // Start the session
    session_start();

    // Destroy the session
    session_unset();
    session_destroy();

    echo "<script>
            localStorage.clear();
            setTimeout(function() {
                window.location.href = '../../index.php';
            }, 100);
        </script>";
        
    exit();