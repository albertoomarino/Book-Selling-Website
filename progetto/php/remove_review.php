<?php
// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION, $_SESSION["name"], $_SESSION["surname"], $_SESSION["username"], $_SESSION["email"], $_SESSION["role"]) && $_SESSION["role"] === "admin") {
    include "../html/top.html";
    include "navbar.php"; ?>
    <section class="remove_review">
        <div class="main_box">
            <h1 class="heading">Remove a review</h1>

            <!-- Paragrafo per mostrare il messaggio nel caso in cui non ci siano prodotti in vendita -->
            <p id="empty_reviews"></p>

            <form name="remove_review_form" id="remove_review_form">
                <!-- Menù a tendina per la scelta del libro da rimuovere -->
                <select class="select_remove_review" name="select_remove_review" id="select_remove_review">
                    <option value="chooseBook" disabled selected>Choose the review you want to remove:</option>
                </select>

                <!-- Bottone per confermare la rimozione del prodotto -->
                <div class="remove_review_advise">
                    <button type="submit" id="remove_review_button">Remove review</button>
                </div>
            </form>
        </div>
    </section>
    <?php
    include "../html/footer.html";
} else {
    header("Location: login.php");
}