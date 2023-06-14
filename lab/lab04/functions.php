<!--
   Laboratorio di Tecnologie WEB - Esercitazione 04
   Nome e Cognome: Alberto Marino
   Matricola: 948258
   Esercizio: Esercitazione 04
-->

<?php
/* personalitytype: ritorna true le due personalità hanno almeno una lettera uguale, false altrimenti */
function personalitytype($personalityA, $personalityB)
{
    return ($personalityA[0] == $personalityB[0] || $personalityA[1] == $personalityB[1]
        || $personalityA[2] == $personalityB[2] || $personalityA[3] == $personalityB[3]);
}

/* seekingage: ritorna true se $min <= $e <= $max, false altrimenti */
function seekingage($e, $min, $max)
{
    return ($e >= $min && $e <= $max);
}

/* usersmatch: ritorna true se due persone hanno caratteristiche simili (si vedano i requisiti), false altrimenti */
function usersmatch($user, $affinity)
{
    list($name, $gender, $age, $personality, $os, $min, $max) = $user;
    list($name_src, $gender_src, $age_src, $personality_src, $os_src, $min_src, $max_src) = $affinity;
    return (
        /* Il genere dell'utente deve essere opposto a quello che si cerca */
        strcmp($gender, $gender_src) != 0 &&
        /* L'età richiesta dell'utente deve essere compresa tra &min e $max */
        seekingage($age_src, $min, $max) &&
        /* Il sistema operativo dell'utente deve essere uguale a quello che si cerca */
        strcmp($os, $os_src) == 0 &&
        /* Il nome dell'utente deve essere diverso da quello che si cerca */
        strcmp($name, $name_src) != 0 &&
        /* La personalità dell'utente deve avere almeno una lettera nella stessa posizione */
        personalitytype($personality, $personality_src)
        );
}
?>