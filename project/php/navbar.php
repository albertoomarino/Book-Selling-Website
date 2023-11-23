<?php

/*
Progetto di Tecnologie Web - A.A. 2022/2023
Università degli Studi di Torino
Alberto Marino - matr. 948258
--
Codice di implementazione della pagina della navbar
*/

// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}
?>

</head>
<body>
<header>
    <!-- Logo getBook() -->
    <img src="../img/slogan.png" alt="logo" class="getBookImg">

    <!-- Composizione della navbar -->
    <nav class="navbar">
        <a href="home.php#home">Home</a>
        <a href="home.php#books">Books</a>
        <a href="home.php#reviews">Reviews</a>
        <a href="home.php#about_us">About us</a>
        <a href="home.php#contact_us">Contact us</a>
        <a href="basket.php" id="basket" title="View your basket"><i class="fa fa-shopping-basket"></i> Basket</a>
        <a id="hello_user" title="<?= $_SESSION["name"] . " " . $_SESSION["surname"] . ", " . $_SESSION["role"] ?>">
            Hi, <span><?= $_SESSION["name"] ?></span>!
        </a>
    </nav>

    <!-- Bottone di logout -->
    <a href="logout.php" title="Return to login page">Logout <i class="fa fa-sign-out"></i></a>
</header>