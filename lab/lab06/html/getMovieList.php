<!--
   Laboratorio di Tecnologie WEB - Esercitazione 06
   Nome e Cognome: Alberto Marino
   Matricola: 948258
   Esercizio: Esercitazione 06
-->

<?php
include("common.php"); // Inclusione del file necessario

// Richiamo tutte le variabili necessarie con _GET
$firstname = $_GET["firstname"];
$lastname = $_GET["lastname"];
$all = $_GET["all"];
$db = connection_db(); // Connessione al DataBase
$firstname = $db->quote($firstname);
$lastname = $db->quote($lastname);

header("Content-type: application/json"); // Invio in formato json dal web server al client

if ($all) {
    $json = searchAll($firstname, $lastname, $db); // Esecuzione della query
    $movielist = array(); // Creazione dell'array
    $res = $json->fetchAll(); // Metto in un array la query e l'assegno a $res
    foreach ($res as $row) { // Ciclo e metto nell'array movielist ogni riga
        $movielist[] = $row;
    }
    print json_encode($movielist); // Invio il json al client
} else { //se all è false
    $json = searchKevin($firstname, $lastname, $db); // Esecuzione della query
    $movielist = array(); // Creazione dell'array
    $res = $json->fetchAll(); // Metto in un array la query e l'assegno a $res
    foreach ($res as $row) { // Ciclo e metto nell'array movielist ogni riga
        $movielist[] = $row;
    }
    print json_encode($movielist); // Invio il json al client
}
?>
