<?php
    function redirectAUTH(){
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /ba/avt.php');//перенаправляє на сторінку яку треба
            exit;
        }
    }

    function authCheck(){
        session_start();
        return isset($_SESSION['user_id']);
    }
?>