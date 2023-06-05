<?php
// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}

/**
 * Funzione per la registrazione di un nuovo utente alla piattaforma.
 * Eseguibile da: tutti gli utenti
 *
 * @return void
 */
function user_subscribe()
{
    if (isset($_SESSION, $_POST["name"], $_POST["surname"], $_POST["username"], $_POST["email"], $_POST["password"])) {
        try {
            // Connessione al database
            $db = db_connection();

            // Sanitizzazione dell'input per eliminare o neutralizzare i caratteri indesiderati all'interno di una stringa
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
            $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $emailValidated = filter_var($email, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

            // Se i seguenti campi sono vuoti, si torna alla pagina di registrazione
            if (empty($name) || empty($surname) || empty($username) || empty($email) || empty($emailValidated) || empty($password)) {
                header("Location: subscribe.php");
            }

            // Codifica dei valori per poterli usare in una query
            $name = $db->quote($_POST["name"]);
            $surname = $db->quote($_POST["surname"]);
            $username = $db->quote($_POST["username"]);
            $email = $db->quote($_POST["email"]);
            $password = $db->quote(md5($_POST["password"])); /* "md5() calcola l'hash MD5 di una stringa */

            // Verifica della presenza dell'utente nel database
            $result = $db->query("SELECT username FROM users WHERE username=$username");

            if ($result != null && $result->rowCount() == 1) {
                // Un utente con l'username inserito è già registrato
                echo "0";
                $_SESSION["advise"] = "A user with the entered username is already registered! Choose another different one!";
            } else {
                // Il nuovo utente è stato creato correttamente
                $db->query("INSERT INTO users (username, name, surname, email, password, role) VALUES ($username, $name, $surname, $email, $password, 'user')");
                $_SESSION["name"] = $_POST["name"];
                $_SESSION["surname"] = $_POST["surname"];
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["password"] = $_POST["password"];
                $_SESSION["role"] = "user";
                echo "1";
            }
            return;
        } catch (PDOException $ex) {
            header("Location: subscribe.php");
        }
    } else {
        header("Location: subscribe.php");
    }
}

/**
 * Funzione per l'accesso di un utente alla piattaforma.
 * Eseguibile da: tutti gli utenti
 *
 * @return void
 */
function user_login()
{
    if (isset($_SESSION, $_POST["username"], $_POST["password"])) {
        try {
            // Connessione al database
            $db = db_connection();

            // Sanitizzazione dell'input per eliminare o neutralizzare i caratteri indesiderati all'interno di una stringa
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

            // Se i seguenti campi sono vuoti, si torna alla pagina di registrazione
            if (empty($username) || empty($password)) {
                header("Location: login.php");
            }

            // Codifica dei valori per poterli usare in una query
            $username = $db->quote($_POST["username"]);
            $password = $db->quote(md5($_POST["password"])); // "md5() calcola l'hash MD5 di una stringa

            // Verifica della presenza dell'utente nel database
            $result = $db->query("SELECT * FROM users WHERE username=$username AND password=$password");

            if ($result != null && $result->rowCount() == 1) {
                // L'utente con l'username inserito è stato trovato
                $logResult = $result->fetch(); // Uso "fetch()" per recuperare i risultati di una query
                $_SESSION["name"] = $logResult["name"];
                $_SESSION["surname"] = $logResult["surname"];
                $_SESSION["username"] = $logResult["username"];
                $_SESSION["email"] = $logResult["email"];
                $_SESSION["password"] = $logResult["password"];
                $_SESSION["role"] = $logResult["role"];
                echo "1";
                return;
            }
            // L'utente con l'username inserito non è stato trovato
            echo "0";
            $_SESSION["advise"] = "The user with the username entered was not found or the password is incorrect. Try again!";
            return;
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}

/**
 * Funzione che mostra i prodotti in vendita sulla piattaforma.
 * Eseguibile da: tutti gli utenti
 *
 * @return void
 */
function show_uploaded_book()
{
    if (isset($_SESSION["username"])) {
        try {
            // Connessione al database
            $db = db_connection();

            // Inizializzazione di un array per la memorizzazione dei risultati della query
            $json = array();
            $query = $db->query("SELECT title, author, price, image FROM products");
            /* Se la query ha restituito risultati (ossia il numero di righe restituito dalla query
             * è maggiore di 0), itera sui risultati e li aggiunge all'array $json */
            if ($query != null && $query->rowCount() > 0) {
                while ($row = $query->fetch()) { // Uso "fetch()" per recuperare i risultati di una query
                    $json[] = $row;
                }
            }
            // Imposta l'intestazione della risposta che indica che i dati restituiti sono nel formato JSON
            header("Content-type: application/json");
            // Codifica e stampa l'array $json in formato JSON
            echo json_encode($json);
            return;
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}

/**
 * Funzione che inserisce un nuovo prodotto in vendita sulla piattaforma.
 * Eseguibile da: ADMIN
 *
 * @return void
 */
function upload_book()
{
    if (isset($_SESSION["username"], $_SESSION["role"], $_POST["title"], $_POST["author"], $_POST["price"], $_POST["publisher"], $_POST["plot"]) && $_SESSION["role"] === "admin") {
        try {
            // Connessione al database
            $db = db_connection();

            // Sanitizzazione dell'input per eliminare o neutralizzare i caratteri indesiderati all'interno di una stringa
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
            $author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_STRING);
            $publisher = filter_input(INPUT_POST, "publisher", FILTER_SANITIZE_STRING);
            $plot = filter_input(INPUT_POST, "plot", FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT);

            // Se i seguenti campi sono vuoti, si torna alla pagina di registrazione
            if (empty($title) || empty($author) || empty($publisher) || empty($plot) || empty($price)) {
                header("Location: login.php");
            }

            // Codifica dei valori per poterli usare in una query
            $title = $db->quote($_POST["title"]);
            $author = $db->quote($_POST["author"]);
            $price = $db->quote($_POST["price"]);
            $publisher = $db->quote($_POST["publisher"]);
            $plot = $db->quote($_POST["plot"]);
            $image = "../imgBooks/" . $title . ".jpg";

            // Rimuovi la prima occorrenza di '
            $image = preg_replace("/'/", "", $image, 1);
            // Rimuovi l'ultima occorrenza di '
            $image = strrev(preg_replace("/'/", "", strrev($image), 1));

            $image = $db->quote($image);
            $result = $db->query("SELECT title FROM products WHERE title=$title");
            if ($result != null && $result->rowCount() > 0) {
                // Il prodotto è già presente
                echo "0";
            } else {
                $db->query("INSERT INTO products (title, author, price, publisher, plot, image) VALUES ($title, $author, $price, $publisher, $plot, $image)");
                // Il prodotto è stato inserito correttamente
                echo "1";
            }
            return;
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}

/**
 * Funzione che selezione i titoli dei prodotti in vendita sulla piattaforma che sono
 * disponibili per la rimozione.
 * Eseguibile da: ADMIN
 *
 * @return void
 */
function show_removed_book()
{
    if (isset($_SESSION["username"], $_SESSION["role"]) && $_SESSION["role"]) {
        try {
            // Connessione al database
            $db = db_connection();

            $result = $db->query("SELECT title FROM products");
            // Imposta l'intestazione della risposta che indica che i dati restituiti sono nel formato JSON
            header("Content-type: application/json");
            // Codifica e stampa i risultati della query in formato JSON
            echo json_encode($result->fetchAll()); // Uso "fetchAll()" per recuperare i risultati di una query
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}

/**
 * Funzione che rimuove un prodotto dalla piattaforma.
 * Eseguibile da: ADMIN
 *
 * @return void
 */
function remove_book()
{
    if (isset($_SESSION["username"], $_SESSION["role"]) && $_SESSION["role"] === "admin") {
        try {
            // Connessione al database
            $db = db_connection();

            $title = $_POST["select_remove"]; /* Prende il valore dalla select */
            // Sanitizzazione dell'input per eliminare o neutralizzare i caratteri indesiderati all'interno di una stringa
            $title = filter_var($title, FILTER_SANITIZE_STRING);

            $result = $db->query("DELETE FROM products WHERE title = '$title'");
            if ($result !== false) {
                // Il prodotto è stato rimosso correttamente
                echo "0";
            } else {
                echo "1";
            }
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        // Utente non autorizzato, reindirizza alla pagina di login
        header("Location: login.php");
    }
}

/**
 * Funzione che visualizza la descrizione dei prodotti presenti sulla piattaforma.
 * Eseguibile da: tutti gli utenti
 *
 * @return void
 */
function show_description_book()
{
    if (isset($_SESSION["username"])) {
        try {
            // Connessione al database
            $db = db_connection();

            $json = array();
            $query = $db->query("SELECT * FROM products");
            /* Se la query ha restituito risultati (ossia il numero di righe restituito dalla query
             * è maggiore di 0), itera sui risultati e li aggiunge all'array $json */
            if ($query != null && $query->rowCount() > 0) {
                while ($row = $query->fetch()) { // Uso "fetch()" per recuperare i risultati di una query
                    $json[] = $row;
                }
            }
            header("Content-type: application/json");
            echo json_encode($json);
            return;
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}

/**
 * Funzione che visualizza i prodotti presenti nel carrello.
 * Eseguibile da: tutti gli utenti
 *
 * @return void
 */
function show_basket()
{
    if (isset($_SESSION["username"])) {
        try {
            // Connessione al database
            $db = db_connection();

            // Inizializzazione di un array per la memorizzazione dei risultati della query
            $json = array();
            // Codifica dei valori per poterli usare in una query
            $username = $db->quote($_SESSION["username"]);

            $query = $db->query("SELECT p.* FROM (cart c JOIN users u ON c.username=u.username) JOIN products p on p.title=c.title WHERE c.username=$username");
            /* Se la query ha restituito risultati (ossia il numero di righe restituito dalla query
             * è maggiore di 0), itera sui risultati e li aggiunge all'array $json */
            if ($query != null && $query->rowCount() > 0) {
                while ($row = $query->fetch()) { // Uso "fetch()" per recuperare i risultati di una query
                    $json[] = $row;
                }
            }
            // Imposta l'intestazione della risposta che indica che i dati restituiti sono nel formato JSON
            header("Content-type: application/json");
            // Codifica e stampa l'array $json in formato JSON
            echo json_encode($json);
            return;
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}

/**
 * Funzione che inserisce un nuovo prodotto nel carrello.
 * Eseguibile da: tutti gli utenti
 *
 * @return void
 */
function upload_to_basket()
{
    if (isset($_SESSION["username"])) {
        try {
            // Connessione al database
            $db = db_connection();

            // Codifica dei valori per poterli usare in una query
            $username = $db->quote($_SESSION["username"]);
            // Titolo del libro che arriva come informazione inviata da AJAX
            $title = $db->quote($_POST["title"]);

            // Verifica se il prodotto è già presente nel carrello dell'utente
            $result = $db->query("SELECT * FROM cart WHERE username = $username AND title = $title");

            if ($result != null && $result->rowCount() > 0) {
                // Prodotto già presente nel carrello
                echo "0";
            } else {
                // Inserimento nel carrello
                $db->query("INSERT INTO cart (username, title) VALUES ($username, $title)");
                echo "1";
            }
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}

/**
 * Funzione che seleziona i titoli dei prodotti nel carrello che sono
 * disponibili per la rimozione.
 * Eseguibile da: tutti gli utenti
 *
 * @return void
 */
function show_removed_book_from_basket()
{
    if (isset($_SESSION["username"])) {
        try {
            // Connessione al database
            $db = db_connection();

            $username = $_SESSION["username"];
            $result = $db->query("SELECT title FROM cart WHERE username = '$username'");
            // Imposta l'intestazione della risposta che indica che i dati restituiti sono nel formato JSON
            header("Content-type: application/json");
            // Codifica e stampa i risultati della query in formato JSON
            echo json_encode($result->fetchAll()); // Uso "fetchAll()" per recuperare i risultati di una query
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}

/**
 * Funzione che rimuove un prodotto dal carrello.
 * Eseguibile da: tutti gli utenti
 *
 * @return void
 */
function remove_book_from_basket()
{
    if (isset($_SESSION["username"])) {
        try {
            // Connessione al database
            $db = db_connection();

            $username = $_SESSION["username"];
            $title = $_POST["select_remove_from_basket"]; // Prende il valore dalla select
            // Sanitizzazione dell'input per eliminare o neutralizzare i caratteri indesiderati all'interno di una stringa
            $title = filter_var($title, FILTER_SANITIZE_STRING);

            $result = $db->query("DELETE FROM cart WHERE username = '$username' AND title = '$title'");
            if ($result !== false) {
                // Il prodotto è stato rimosso correttamente
                echo "0";
            } else {
                echo "1";
            }
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        // Utente non autorizzato, reindirizza alla pagina di login
        header("Location: login.php");
    }
}

/**
 * Funzione che completa l'ordine al momento del check-out.
 * Eseguibile da: tutti gli utenti
 *
 * @return int|void
 */
function complete_order()
{
    if (isset($_SESSION["username"])) {
        try {
            $db = db_connection();

            // Codifica dei valori per poterli usare in una query
            $username = $db->quote($_SESSION["username"]);
            $result = $db->query("DELETE FROM cart WHERE username=$username");
            if ($result !== false) {
                // Elementi rimossi dal carrello!
                echo "1";
            } else {
                echo "0";
            }
            return 1;
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}

/**
 * Funzione che visualizza i prodotti presenti nella sezione "Reviews".
 * Eseguibile da: tutti gli utenti
 *
 * @return void
 */
function show_reviews()
{
    if (isset($_SESSION["username"])) {
        try {
            // Connessione al database
            $db = db_connection();

            // Inizializzazione di un array per la memorizzazione dei risultati della query
            $json = array();

            $query = $db->query("SELECT * FROM reviews");
            /* Se la query ha restituito risultati (ossia il numero di righe restituito dalla query
             * è maggiore di 0), itera sui risultati e li aggiunge all'array $json */
            if ($query != null && $query->rowCount() > 0) {
                while ($row = $query->fetch()) { // Uso "fetch()" per recuperare i risultati di una query
                    $json[] = $row;
                }
            }
            // Imposta l'intestazione della risposta che indica che i dati restituiti sono nel formato JSON
            header("Content-type: application/json");
            // Codifica e stampa l'array $json in formato JSON
            echo json_encode($json);
            return;
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}

/**
 * Funzione che inserisce una nuova recensione.
 * Eseguibile da: tutti gli utenti
 *
 * @return void
 */
function upload_review()
{
    if (isset($_SESSION["username"], $_SESSION["role"], $_POST["select_remove"], $_POST["text"])) {
        try {
            // Connessione al database
            $db = db_connection();

            $username = $_SESSION["username"];
            $title = $_POST["select_remove"];
            $text = $_POST["text"];

            // Se i seguenti campi sono vuoti, si torna alla pagina di registrazione
            if (empty($username) || empty($title) || empty($text)) {
                header("Location: login.php");
                return;
            }

            // Codifica dei valori per poterli usare in una query
            $username = $db->quote($username);
            $title = $db->quote($title);
            $text = $db->quote($text);

            $result = $db->query("SELECT username, title FROM reviews WHERE username=$username AND title=$title");

            if ($result != null && $result->rowCount() > 0) {
                // La recensione dell'utente su un determinato libro è già presente
                echo "0";
            } else {
                $db->query("INSERT INTO reviews (username, title, text) VALUES ($username, $title, $text)");
                // La recensione è stata inserita correttamente
                echo "1";
            }
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}

/**
 * Funzione che rimuove un prodotto dalla piattaforma.
 * Eseguibile da: ADMIN
 *
 * @return void
 */
function remove_review()
{
    if (isset($_SESSION["username"], $_SESSION["role"]) && $_SESSION["role"] === "admin") {
        try {
            // Connessione al database
            $db = db_connection();

            $review_option = $_POST["select_remove_review"]; // Prende il valore dalla select
            // Sanitizzazione dell'input per eliminare o neutralizzare i caratteri indesiderati all'interno di una stringa
            $review_option = filter_var($review_option, FILTER_SANITIZE_STRING);

            // Separo l'username e il titolo dalla stringa ricevuta
            $username = "";
            $title = "";
            $parts = explode(", ", $review_option);
            if (count($parts) === 2) {
                $username = $parts[0];
                $title = $parts[1];
            }

            // Query per eliminare la recensione
            $deleteQuery = "DELETE FROM reviews WHERE username = :username AND title = :title";
            $deleteStmt = $db->prepare($deleteQuery);
            $deleteStmt->bindParam(":username", $username);
            $deleteStmt->bindParam(":title", $title);
            $deleteResult = $deleteStmt->execute();

            if ($deleteResult !== false) {
                // La recensione è stata rimossa correttamente
                echo "0";
            } else {
                echo "1";
            }
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        // Utente non autorizzato, reindirizza alla pagina di login
        header("Location: login.php");
    }
}

/**
 * Funzione che seleziona i titoli dei prodotti in vendita sulla piattaforma che sono
 * disponibili per la rimozione.
 * Eseguibile da: ADMIN
 *
 * @return void
 */
function show_removed_reviews()
{
    if (isset($_SESSION["username"], $_SESSION["role"]) && $_SESSION["role"] === "admin") {
        try {
            // Connessione al database
            $db = db_connection();

            $result = $db->query("SELECT username, title FROM reviews");
            // Imposta l'intestazione della risposta che indica che i dati restituiti sono nel formato JSON
            header("Content-type: application/json");
            // Codifica e stampa i risultati della query in formato JSON
            echo json_encode($result->fetchAll()); // Uso "fetchAll()" per recuperare i risultati di una query
        } catch (PDOException $ex) {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
}