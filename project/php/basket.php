<?php

/*
Progetto di Tecnologie Web - A.A. 2022/2023
Università degli Studi di Torino
Alberto Marino - matr. 948258
--
Codice di implementazione della sezione "Basket"
*/

// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION, $_SESSION["name"], $_SESSION["surname"], $_SESSION["username"])) {
    include "../html/top.html";
    include "navbar.php"; ?>
    <section class="basket">
        <div class="main_box">
            <h1 class="heading"><?= $_SESSION["name"] ?>, this is your shopping basket</h1>
            <!-- Bottone per che rimanda alla pagina per la rimozione di un prodotto dal carrello -->
            <div id="remove_button">
                <a href="remove_book_from_basket.php" id="remove_book_from_basket">Remove books from your cart</a>
            </div>
            <!-- Paragrafo per mostrare il messaggio nel caso in cui non ci siano prodotti nel carrello -->
            <p id="empty_basket"></p>
            <!-- Paragrafo per mostrare il prezzo totale dei prodotti presenti nel carrello -->
            <p id="total_basket_price"></p>
            <!-- Box per la visualizzazione di un singolo prodotto nel carrello -->
            <div id="basket_book_box">
                <!-- Titolo di un singolo prodotto -->
                <div class="description_box_book" id="description_box_book"></div>
            </div>
        </div>
    </section>
    <?php
    include "../html/footer.html";
} else {
    // Utente non autorizzato
    header("Location: login.php");
}