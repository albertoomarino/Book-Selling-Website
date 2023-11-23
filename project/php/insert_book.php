<?php

/*
Progetto di Tecnologie Web - A.A. 2022/2023
Università degli Studi di Torino
Alberto Marino - matr. 948258
--
Codice di implementazione della pagina di inserimento dei prodotti
*/

// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION, $_SESSION["name"], $_SESSION["surname"], $_SESSION["username"], $_SESSION["email"], $_SESSION["role"]) && $_SESSION["role"] === "admin") {
    include "../html/top.html";
    include "navbar.php";
    include "../html/insert_book.html";
    include "../html/footer.html";
} else {
    // Utente non autorizzato
    header("Location: login.php");
}