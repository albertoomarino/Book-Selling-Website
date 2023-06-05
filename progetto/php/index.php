<?php
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
        <form action="login.php">
            <button class="button" id="login">Login</button>
        </form>

        <form action="subscribe.php">
            <button class="button" id="subscribe">Subscribe</button>
        </form>
    </div>
</div>
</body>
</html>