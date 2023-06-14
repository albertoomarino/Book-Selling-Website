<!--
   Laboratorio di Tecnologie WEB - Esercitazione 06
   Nome e Cognome: Alberto Marino
   Matricola: 948258
   Esercizio: Esercitazione 06
-->

<?php
function connection_db()
{ // Funzione per la connessione al DataBase
    try {
        $db = new PDO("mysql:dbname=imdb_small;host=localhost:3306", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $ex) {
        die("Could not connect: " . $ex->getMessage()); //die equivale all'exit
    }
}

function searchAll($firstname, $lastname, $db)
{
    try { // Esecuzione della query e controllo dell'eccezione
        $rows = $db->query("SELECT name, year
                        FROM movies JOIN roles ON (movies.id = movie_id) 
                        JOIN actors ON (actor_id = actors.id)
                        WHERE first_name = $firstname AND last_name = $lastname
                        ORDER BY movies.year DESC, movies.name ASC");
    } catch (PDOException $ex) {
        die("Query failed: " . $ex->getMessage());
    }

    return $rows;
}

function searchKevin($firstname, $lastname, $db)
{
    try { // Esecuzione della query e controllo dell'eccezione
        $rows = $db->query("SELECT m.name, m.year 
                        FROM movies m JOIN roles r1 ON (m.id = r1.movie_id)
                        JOIN actors a1 ON (r1.actor_id = a1.id) 
                        JOIN roles r2 ON (m.id = r2.movie_id) 
                        JOIN actors a2 ON (r2.actor_id = a2.id) 
                        WHERE a1.first_name = $firstname AND a1.last_name = $lastname AND a2.first_name = 'Kevin' AND a2.last_name = 'Bacon'
                        ORDER BY m.year DESC, m.name ASC");
    } catch (PDOException $ex) {
        die("Query failed: " . $ex->getMessage());
    }

    return $rows;
}
?>
