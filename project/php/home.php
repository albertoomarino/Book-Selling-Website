<?php

/*
Progetto di Tecnologie Web - A.A. 2022/2023
Università degli Studi di Torino
Alberto Marino - matr. 948258
--
Codice di implementazione della Homepage
*/

// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION, $_SESSION["name"], $_SESSION["surname"], $_SESSION["username"], $_SESSION["email"], $_SESSION["role"])) {
    include "../html/top.html";
    include "navbar.php";
    include "../html/home.html";
    include "books.php";
    include "reviews.php";
    include "../html/about_us.html";
    include "../html/contact_us.html";
    include "../html/footer.html";
} else {
    // Utente non autorizzato
    header("Location: login.php");
}