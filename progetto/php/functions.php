<?php
// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}

/**
 * La condizione isset($_POST) viene utilizzata per verificare se sono stati inviati dei dati
 * tramite una richiesta POST
 *
 * Codice per la gestione delle richieste POST provenienti dalla pagina web
 * In base al valore di $_POST["to_do"], vengono inclusi file PHP specifici che contengono
 * le funzioni associate a ciascuna azione
 */
if (isset($_POST["to_do"])) {
    include "functions_implementation.php";

    $action = $_POST["to_do"];

    switch ($action) {
        case "user_subscribe":
            user_subscribe();
            break;
        case "user_login":
            user_login();
            break;
        case "show_uploaded_book":
            show_uploaded_book();
            break;
        case "upload_book":
            upload_book();
            break;
        case "show_removed_book":
            show_removed_book();
            break;
        case "remove_book":
            remove_book();
            break;
        case "show_description_book":
            show_description_book();
            break;
        case "show_basket":
            show_basket();
            break;
        case "upload_to_basket":
            upload_to_basket();
            break;
        case "show_removed_book_from_basket":
            show_removed_book_from_basket();
            break;
        case "remove_book_from_basket":
            remove_book_from_basket();
            break;
        case "complete_order":
            complete_order();
            break;
        case "show_reviews":
            show_reviews();
            break;
        case "upload_review":
            upload_review();
            break;
        case "remove_review":
            remove_review();
            break;
        case "show_removed_reviews":
            show_removed_reviews();
            break;
    }
}

/**
 * Funzione per la connessione al database
 *
 * @return PDO
 */
function db_connection(): PDO
{
    $host = 'localhost';
    $dbname = 'getbook';
    $username = 'root';
    $password = '';

    try {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        return new PDO($dsn, $username, $password, $options);
    } catch (PDOException $ex) {
        die('Connection failed: ' . $ex->getMessage());
    }
}