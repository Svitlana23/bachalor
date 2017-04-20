<?php
        if(isset($_POST['login']) && isset($_POST['password']))
        {
            session_start();
            include "on.php";
            $email = $_POST['login'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = mysql_query($sql);
            
            if(mysql_num_rows($result) == 0)
            {
                echo "<script>alert(\"Користувача з таким email та паролем не існує! Зареєструйтесь!\");</script>";
                //header('Location: /ba/register.php');
            }
            else{
                $row = mysql_fetch_array($result);
                $_SESSION['user_id'] = $row['id_user'];
                header('Location: /ba');
            }
        }
    //для виходу кнопка і ссилка, що перенаправляє на скріпт виходу , ссилка бо не треба відправляти дані
?>

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
    <title>Avtorisation</title>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <div class="login-wrap">
	<div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Увійти</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Зареєструватись</label>
            <div class="login-form">
                <div class="sign-in-htm">
                   <form role="form" method="POST">
                        <div class="group">
                            <label for="user" class="label">Логін</label>
                            <input type="text" class="input" name="login">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Пароль</label>
                            <input type="password" class="input" data-type="password" name="password">
                        </div>
                        <div class="group">
                            <input id="check" type="checkbox" class="check" checked>
                            <label for="check"><span class="icon"></span> Keep me Signed in</label>
                        </div>
                        <div class="group">
                            <button type="submit" class="button" name="submit">Увійти</button>
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="#forgot">Забули пароль?</a>
                        </div>
                    </form>
                </div>
                <div class="sign-up-htm">
                  <form action="" method="post" id = "reg">
                   <div class="group">
                        <label for="name" class="label">Ім'я</label>
                        <input id="name" type="text" class="input" name="name">
                    </div>
                    <div class="group">
                        <label for="surname" class="label">Прізвище</label>
                        <input id="surname" type="text" class="input" name="surname">
                    </div>
                    <div class="group">
                        <label for="username" class="label">Username</label>
                        <input id="username" type="text" class="input" name="username">
                    </div>
                    <div class="group">
                        <label for="email" class="label">E-mail</label>
                        <input id="email" type="text" class="input" name="email">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="password" type="password" class="input" data-type="password" name="password">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Repeat Password</label>
                        <input id="password2" type="password" class="input" data-type="password" name="password2">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Зареєструватись" name="submit" id="reg">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1"><a href="">Already Member?</a></label>
                    </div>
                    </form>
                </div>
            </div>
	</div>
</div>
<!--
  
   <div class="form mypanel">
    <form class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Логін</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Логін" name="login">
        </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" placeholder="Пароль" name="password">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default btn-sm" name="submit">Увійти</button>
              <a href="register.php" class="btn btn-default btn-sm">Реєстрація</a>
            </div>
          </div>  
      </div>  
    </form>
    </div>
-->
</body>
</html>