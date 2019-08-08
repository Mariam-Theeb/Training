<?php
    session_start();
    session_destroy();
    header('Location: myaction.php');
    exit;
?>