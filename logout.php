<?php
    session_start();
    session_destroy();
    header("Location: /ba/avt.php");
?>