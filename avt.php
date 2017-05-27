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
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['password2']) && $_POST['username']!="" && $_POST['email']!="" && $_POST['password']!="" && $_POST['password2']!="" && $_POST['password'] == $_POST['password2'])
    {
        session_start();
        include "on.php";
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $result = mysql_query("SELECT * FROM users WHERE email = '$email' AND username = '$username'");
        if(mysql_num_rows($result) == 0)
        {
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
                mysql_query($sql);
                $id = mysql_insert_id();
                $_SESSION['user_id'] = $id;
                echo "<script>alert(\"Авторизація пройшла успішно! Ви зареєстровані як\"".$username.");</script>";
               
                header('Location: /ba');
        }
        else{
            echo "<script>alert(\"Користувач з таким іменем вже зареєстрований\");</script>";
        }
    }//для виходу кнопка і ссилка, що перенаправляє на скріпт виходу , ссилка бо не треба відправляти дані
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Avtorisation</title>
    <link rel="stylesheet" href="css/style2.css">
<!--    <link rel="stylesheet" href="css/bootstrap-theme.min.css">-->
    <link rel='stylesheet prefetch' href='css/fonts.css'>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <div class="login-wrap">
	<div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">SIGN IN</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">SIGN UP</label>
            <div class="login-form">
                <div class="sign-in-htm">
                   <form role="form" method="POST">
                        <div class="group">
                            <label for="user" class="label">Username</label>
                            <input type="text" class="input" name="login">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input type="password" class="input" data-type="password" name="password">
                        </div>
                        <div class="group">
                            <input id="check" type="checkbox" class="check" checked>
                            <label for="check"><span class="icon"></span> Keep me Signed in</label>
                        </div>
                        <div class="group">
                            <button type="submit" class="button" name="submit">SIGN IN</button>
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="#forgot">Forgot Password?</a>
                        </div>
                    </form>
                </div>
                <div class="sign-up-htm">
                  <form action="" method="post" id = "reg1">
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
                        <input type="submit" class="button" value="Sign Up" name="submit" id="reg">
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
<script>
        document.getElementById('reg1').onsubmit=function(e){
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