<?php

/*
Progetto di Tecnologie Web - A.A. 2022/2023
Università degli Studi di Torino
Alberto Marino - matr. 948258
--
Codice di implementazione della pagina di logout
*/

// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}

// Se è presente una sessione la cancello
if (isset($_SESSION)) {
    // Vengono rimosse tutte le variabili di sessione
    session_unset();
    // Viene distrutta la sessione
    session_destroy();
}
header("Location: login.php");