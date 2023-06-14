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
    <form action="signup-submit.php" method="post">

        <fieldset>
            <legend>
                New User SignUp:
            </legend>
            <br>

            <!-- Campo di testo "Name" -->
            <div class="column">
                <label>
                    <strong>Name:</strong>
                </label>
            </div>
            <input class="match" type="text" name="Name" size="16"> <br>

            <!-- Radio button "Gender" -->
            <div class="column">
                <label>
                    <strong>Gender:</strong>
                </label>
            </div>
            <input class="match" type="radio" name="Gender" value="M" checked="checked"> Male
            <input class="match" type="radio" name="Gender" value="F" checked="checked"> Female
            <br>

            <!-- Campo di testo "Age" -->
            <div class="column">
                <label>
                    <strong>Age:</strong>
                </label>
            </div>
            <input class="match" type="text" name="Age" size="6" maxlength="2">
            <br>

            <!-- Campo di testo "Personality type" -->
            <div class="column">
                <label>
                    <strong>Personality type:</strong>
                </label>
            </div>
            <input class="match" type="text" name="PersonalityType" size="6" maxlength="4">
            (<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know your type?</a>)
            <br>

            <!-- Menù a tendina "Favourite OS" -->
            <div class="column">
                <label>
                    <strong>Favourite OS:</strong>
                </label>
            </div>
            <select class="match" name="FavouriteOS">
                <option>Windows</option>
                <option>Mac OS X</option>
                <option selected="selected">Linux</option>
            </select>
            <br>

            <!-- Campi di testo "Seeking age" -->
            <div class="column">
                <label>
                    <strong>Seeking age:</strong>
                </label>
            </div>
            <input class="match" type="text" name="SeekingAgeMin" size="6" maxlength="2" placeholder="min">
            to <input class="match" type="text" name="SeekingAgeMax" size="6" maxlength="2" placeholder="max">
            <br>

            <!-- Bottone "Sign Up" -->
            <input type="submit" value="Sign Up">
    </form>
    </fieldset>
</div>
</body>
</html>

<?php include "bottom.html"; ?>
