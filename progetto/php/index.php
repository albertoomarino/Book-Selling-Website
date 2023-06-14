<?php

/*
Progetto di Tecnologie Web - A.A. 2022/2023
Università degli Studi di Torino
Alberto Marino - matr. 948258
--
Codice di implementazione della pagina iniziale
*/

// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>getBook()</title>
</head>

<body>
<div class="main_box">
    <h1>Welcome to <span>getBook()</span>!</h1>
    <img src="../img/logo.png" alt="getBook() logo">
    <h2>If you already have an account <span>login</span>, otherwise <span>subscribe</span> on the website!</h2>

    <div class="both">
        <!-- Link alla pagina di login -->
        <form action="login.php">
            <button class="button" id="login">Login</button>
        </form>

        <!-- Link alla pagina di subscribe -->
        <form action="subscribe.php">
            <button class="button" id="subscribe">Subscribe</button>
        </form>
    </div>
</div>
</body>
</html>