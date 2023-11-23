<?php

/*
Progetto di Tecnologie Web - A.A. 2022/2023
Università degli Studi di Torino
Alberto Marino - matr. 948258
--
Codice di implementazione della pagina di login
*/

// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap">
    <link rel="stylesheet" href="../css/access.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../javascript/functions.js" type="text/javascript"></script>
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>getBook()</title>
</head>

<body>
<form id="login_form" accept-charset="utf-8">
    <div class="main_box" id="login">
        <h1>Login to <span>getBook()</span>!</h1>

        <!-- Avviso per il messaggio di errore -->
        <?php
        if (isset($_SESSION["advise"])) {
            ?>
            <p id="log_check_result"><?= $_SESSION["advise"] ?></p>
            <?php
            unset($_SESSION["advise"]);
            session_unset();
            session_destroy();
            session_start();
        }
        ?>

        <!-- Campo per l'inserimento dell'username -->
        <div class="input_box">
            <input type="text" id="username"
                   name="username" pattern="[a-z]{4,16}"
                   title="The minimum length of the username is 4 characters, while the maximum length is 16 characters."
                   minlength="4"
                   maxlength="16"
                   placeholder="Insert your username"
                   required>
        </div>

        <!-- Campo per l'inserimento della password -->
        <div class="input_box">
            <input type="password"
                   id="password"
                   name="password"
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   title="The password must be at least 8 characters long and must contain at least one number and one capital letter."
                   minlength="8"
                   placeholder="Insert your password"
                   required>
        </div>

        <!-- Checkbox per mostrare/nascondere la password -->
        <div class="show_hide">
            <input type="checkbox" onclick="show_hide_psw()">Show password
        </div>

        <!-- Bottone per effettuare il login -->
        <button type="submit" class="button">Login</button>

        <!-- Link alla pagina di registrazione -->
        <p id="foot_p">Don't have an account yet? <a id="foot_a" href="subscribe.php">Subscribe</a></p>

        <!-- Link all'index -->
        <p id="foot_p">Otherwise, go <a id="foot_a" href="index.php">back</a>!</p>
    </div>
</form>
</body>
</html>