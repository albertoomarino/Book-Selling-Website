<?php
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