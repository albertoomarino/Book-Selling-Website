<?php

/*
Progetto di Tecnologie Web - A.A. 2022/2023
Università degli Studi di Torino
Alberto Marino - matr. 948258
--
Codice di implementazione della pagina di subscribe
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
<form id="subscribe_form" accept-charset="utf-8">
    <div class="main_box" id="subscribe">
        <h1>Subscribe to <span>getBook()</span>!</h1>

        <!-- Avviso per il messaggio di errore -->
        <?php
        if (isset($_SESSION["advise"])) {
            ?>
            <p id="sub_check_result"><?= $_SESSION["advise"] ?></p>
            <?php
            unset($_SESSION["advise"]);
            session_unset();
            session_destroy();
            session_start();
        }
        ?>

        <!-- Campo per l'inserimento del nome -->
        <div class="input_box">
            <input type="text"
                   id="name"
                   name="name"
                   pattern="^(?=.{1,32}$)([A-Z][a-zA-Z]*)(\s[A-Z][a-zA-Z]*)?$"
                   title="Respect the format! Capitalize only the first letter and enter up to two names for a maximum of 32 characters"
                   maxlength="32"
                   placeholder="Insert your name"
                   required="required">
        </div>

        <!-- Campo per l'inserimento del cognome -->
        <div class="input_box">
            <input type="text"
                   id="surname"
                   name="surname"
                   pattern="^[A-Z][A-Za-z]{0,31}$"
                   title="Respect format! Capitalize only the first letter for up to 32 characters"
                   maxlength="32"
                   placeholder="Insert your surname"
                   required="required">
        </div>

        <!-- Campo per l'inserimento dell'username -->
        <div class="input_box">
            <input type="text"
                   id="username"
                   name="username"
                   pattern="^[a-z]{4,16}$"
                   title="Respect the format! Use only lowercase letters for a minimum of 4 characters and a maximum of 16 characters"
                   minlength="4"
                   maxlength="16"
                   placeholder="Insert your username"
                   required="required">
        </div>

        <!-- Campo per l'inserimento della email -->
        <div class="input_box">
            <input type="email"
                   id="email"
                   name="email"
                   pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                   title="Respect the format! 'prefix@domain', where the prefix consists of lowercase letters. The maximum length of the email must be 32 characters"
                   placeholder="Insert your email"
                   required="required">
        </div>

        <!-- Campo per l'inserimento della password -->
        <div class="input_box">
            <input type="password"
                   id="password"
                   name="password"
                   pattern="^(?=.*[A-Z])(?=.*\d).{8,}$"
                   title="Respect the format! Use at least one number and one capital letter for a minimum of 8 characters"
                   minlength="8"
                   placeholder="Insert your password"
                   required="required">
        </div>

        <!-- Checkbox per mostrare/nascondere la password -->
        <div class="show_hide">
            <input type="checkbox" onclick="show_hide_psw()">Show password
        </div>

        <!-- Bottone "subscribe" -->
        <button type="submit" class="form_btn">Subscribe</button>

        <!-- Link alla pagina di login -->
        <p id="foot_p">Already have an account? <a id="foot_a" href="login.php">Login</a></p>

        <!-- Link all'index -->
        <p id="foot_p">Otherwise, go <a id="foot_a" href="index.php">back</a>!</p>
    </div>
</form>
</body>

</html>