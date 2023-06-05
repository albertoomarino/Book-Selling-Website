<?php
// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION, $_SESSION["name"], $_SESSION["surname"], $_SESSION["username"], $_SESSION["email"], $_SESSION["role"])) {
    include "../html/top.html";
    include "navbar.php"; ?>
    <section class="remove_book_from_basket">
        <div class="main_box">
            <h1 class="heading">Remove a book from your shopping basket</h1>

            <!-- Paragrafo per mostrare il messaggio nel caso in cui non ci siano prodotti in vendita -->
            <p id="empty_remove_from_basket_db"></p>

            <form name="remove_book_from_basket_form" id="remove_book_from_basket_form">
                <!-- Menù a tendina per la scelta del libro da rimuovere -->
                <select class="select_remove_from_basket" name="select_remove_from_basket"
                        id="select_remove_from_basket">
                    <option value="choose_book_to_remove_from_basket" disabled selected>
                        Choose the book you want to remove from your cart:
                    </option>
                </select>

                <!-- Bottone per confermare la rimozione del prodotto -->
                <div class="remove_book_from_basket_advise">
                    <button type="submit" id="remove_book_from_basket_button">Remove book</button>
                </div>
            </form>
        </div>
    </section>
    <?php
    include "../html/footer.html";
} else {
    header("Location: login.php");
}