<?php
    session_start();
    session_unset();
    session_destroy();

    // Clear cookies
    setcookie("user_data", "", time() - 3600, "/");

    header("Location: index.php");
    exit();
?>