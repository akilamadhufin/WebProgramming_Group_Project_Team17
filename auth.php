<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Clear output buffers and turn off output buffering
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
    
    // Send header
    header("Location: loginform.php");
    exit();
}
?>
