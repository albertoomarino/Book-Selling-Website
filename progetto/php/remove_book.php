<?php
// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION, $_SESSION["name"], $_SESSION["surname"], $_SESSION["username"], $_SESSION["email"], $_SESSION["role"]) && $_SESSION["role"] === "admin") {
    include "../html/top.html";
    include "navbar.php"; ?>
    <section class="remove_book">
        <div class="main_box">
            <h1 class="heading">Remove a book from those available</h1>

            <!-- Paragrafo per mostrare il messaggio nel caso in cui non ci siano prodotti in vendita -->
            <p id="empty_remove_db"></p>

            <!-- Menù a tendina per la scelta del libro da rimuovere -->
            <form name="remove_book_form" id="remove_book_form">
                <select class="select_remove" name="select_remove" id="select_remove">
                    <option value="chooseBook" disabled selected>Choose the book you want to remove:</option>
                </select>
                <!-- Bottone per confermare la rimozione del prodotto -->
                <div class="remove_book_advise">
                    <button type="submit" id="remove_book_button">Remove book</button>
                </div>
            </form>
        </div>
    </section>
    <?php
    include "../html/footer.html";
} else {
    header("Location: login.php");
}