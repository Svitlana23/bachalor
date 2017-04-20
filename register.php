<?php

    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['password2']) && $_POST['name']!="" && $_POST['surname']!="" && $_POST['username']!="" && $_POST['email']!="" && $_POST['password']!="" && $_POST['password2']!="" && $_POST['password'] == $_POST['password2'])
    {
        session_start();
        include "on.php";
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $result = mysql_query("SELECT * FROM users WHERE email = '$email' AND username = '$username'");
        if(mysql_num_rows($result) == 0)
        {
                $sql = "INSERT INTO users (name, surname, username, email, password) VALUES ('$name', '$surname', '$username', '$email', '$password')";
                mysql_query($sql);
                $id = mysql_insert_id();
                $_SESSION['user_id'] = $id;
                echo "<script>alert(\"Авторизація пройшла успішно! Ви зареєстровані як\"".$username.");</script>";
               
                header('Location: /ba');
        }
        else{
            echo "<script>alert(\"Користувач з таким іменем вже зареєстрований\");</script>";
            //exit;
        }
    }//для виходу кнопка і ссилка, що перенаправляє на скріпт виходу , ссилка бо не треба відправляти дані
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form action="" method="post" id = "reg">
           <br> name
        <input type="text" name="name" id = "name">
        <br> surname
        <input type="text" name="surname" id="surname">
        <br>username
        <input type="text" name="username" id="username">
        <br> email
        <input type="text" name="email" id="email">
        <br>password
        <input type="password" name="password" id="password">
        <br>password2
        <input type="password" name="password2" id="password2">
        <br>
        <input type="submit" name="submit" id = "reg" value="Зареєструватись">
        <a href="avt.php">Увійти</a>
    </form>
    <script>
        document.getElementById('reg').onsubmit=function(e){
            if(document.getElementById('name').value==""){
                alert("Заповніть поле ім'я прізвище користувацьке імя пароль!");
                e.preventDefault();
                return;
            }
            if(document.getElementById('surname').value==""){
                alert("Заповніть поле прізвище!");
                e.preventDefault();
                return;
            }
            if(document.getElementById('username').value==""){
                alert("Заповніть поле username!");
                e.preventDefault();
                return;
            }
            if(document.getElementById('email').value==""){
                alert("Заповніть поле email!");
                e.preventDefault();
                return;
            }
            if(document.getElementById('password').value==""){
                alert("Заповніть поле пароль!");
                e.preventDefault();
                return;
            }
            if(document.getElementById('password2').value==""){
                alert("Заповніть поле 'повторіть пароль'!");
                e.preventDefault();
                return;
            }
            if(document.getElementById('password').value != document.getElementById('password2').value){
                alert("Паролі не співпадають!");
                e.preventDefault();
                return;
            }
        };
    </script>
</body>
</html>