<?php
// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION, $_SESSION["name"], $_SESSION["surname"], $_SESSION["username"], $_SESSION["email"], $_SESSION["role"])) {
    include "../html/top.html";
    include "navbar.php"; ?>
    <section class="view_book">
        <!-- Box dell'intera schermata del prodotto -->
        <div class="main_box">
            <h1 class="heading">View features of books for sale</h1>
            <!-- Box per la visualizzazione delle caratteristiche di un singolo prodotto -->
            <div id="selected_book">
                <!-- Descrizione della card di un singolo prodotto (Titolo, Autore e Prezzo) -->
                <div class="description_selected_book" id="description_selected_book"></div>
            </div>
        </div>
    </section>
    <?php
    include "../html/footer.html";
} else {
    header("Location: login.php");
}