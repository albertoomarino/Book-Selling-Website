<!--
   Laboratorio di Tecnologie WEB - Esercitazione 04
   Nome e Cognome: Alberto Marino
   Matricola: 948258
   Esercizio: Esercitazione 04
-->

<?php include "top.html"; ?>

<p>
    <strong>Thank you!</strong> <br>
</p>

<?php
print "Welcome to NerdLuv, " . $name = $_POST['Name'] . "!<br>";

/* Accesso al file singles.txt e aggiunta dati */
$new_text = "\n" . $_POST['Name'] . "," . $_POST['Gender'] . "," . $_POST['Age'] . "," . $_POST['PersonalityType']
    . "," . $_POST['FavouriteOS'] . "," . $_POST['SeekingAgeMin'] . "," . $_POST['SeekingAgeMax'];
file_put_contents("singles.txt", $new_text, FILE_APPEND);
?>

<p>
    Now <a href="matches.php">log in to see your matches!</a>
</p>

<?php include "bottom.html"; ?>
