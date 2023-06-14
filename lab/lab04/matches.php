<!--
   Laboratorio di Tecnologie WEB - Esercitazione 04
   Nome e Cognome: Alberto Marino
   Matricola: 948258
   Esercizio: Esercitazione 04
-->

<?php include "top.html"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NerdLuv</title>
    <meta charset="utf-8">
    <link href="http://www.cs.washington.edu/education/courses/cse190m/12sp/homework/4/heart.gif" type="image/gif"
          rel="shortcut icon">
    <link href="nerdluv.css" type="text/css" rel="stylesheet">
</head>

<body>
<div class="match">
    <!-- Inizio gestione FORM -->
    <form action="matches-submit.php" method="get">

    <fieldset>
        <legend>
            New User SignUp:
        </legend>
        <br>

            <!-- Campo di testo "Name" -->
            <div class="column">
                <strong>Name:</strong>
            </div>
            <input class="match" type="text" name="Name" size="16"> <br>

            <!-- Bottone "View My Matches" -->
            <input type="submit" value="View My Matches">
        </form>
    </fieldset>
</div>
</body>
</html>

<?php include "bottom.html"; ?>
