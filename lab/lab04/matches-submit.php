<!--
   Laboratorio di Tecnologie WEB - Esercitazione 04
   Nome e Cognome: Alberto Marino
   Matricola: 948258
   Esercizio: Esercitazione 04
-->

<?php include "top.html"; ?>

<?php
/* Prendo in in input 'Name' utilizzando $_REQUEST */
$name = $_REQUEST['Name'];
$singles = file("singles.txt", FILE_IGNORE_NEW_LINES);
/* Divido la riga in un array per ogni persona */
for ($i = 0; $i < count($singles); $i++) {
    $affinity = explode(',', $singles[$i]);
    /* Quando trovo l'utente mi salvo i dati */
    if (strcmp($affinity[0], $name) == 0) {
        $userdata = $affinity;
    }
    $user[$i] = $affinity;
}
?>

<h1><strong>Matches for <?= $name ?></strong></h1>

<?php
/* Richiamo il file functions.php in modo da rendere visibili le funzioni implementate */
require "functions.php";

/* Verifico se ogni persona rispetta i criteri per essere considerata */
foreach ($user as $user_src) {
    if (usersmatch($userdata, $user_src)) {
        list($name_src, $gender_src, $age_src, $personality_src, $os_src, $min_src, $max_src) = $user_src;
        ?>

        <div class="match">
            <p>
                <img src="https://courses.cs.washington.edu/courses/cse190m/12sp/homework/4/user.jpg" alt="user"/>
                <?= $name_src ?>
            </p>
            <ul>
                <li>
                    <label><strong>gender:</strong></label>
                    <label><?= $gender_src ?></label>
                </li>

                <li>
                    <label><strong>age:</strong></label>
                    <label><?= $age_src ?></label>
                </li>

                <li>
                    <label><strong>type:</strong></label>
                    <label><?= $personality_src ?></label>
                </li>

                <li>
                    <label><strong>os:</strong></label>
                    <label><?= $os_src ?></label>
                </li>
            </ul>
        </div>
        <?php
    }
}
include "bottom.html";
?>
