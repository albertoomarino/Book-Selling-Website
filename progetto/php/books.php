<?php
// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}
?>

<section class="books" id="books">
    <form class="books_form">
        <h1 class="heading">Books for sale</h1>

        <!-- Bottone per visitare le informazioni sui prodotti -->
        <a href="view_book.php" id="view_book_page">View the descriptions of the products for sale</a>

        <?php
        if ($_SESSION["role"] === "admin") {
            ?>
            <div id="insert_and_remove">
                <a href="insert_book.php" id="insert_book_button">Add new book</a>
                <a href="remove_book.php" id="remove_book_button">Remove book</a>
            </div>
            <?php
        }
        ?>
        <!-- Paragrafo per mostrare il messaggio nel caso in cui non ci siano prodotti in vendita -->
        <p id="empty_insert_db"></p>
        <!-- Box dell'intera schermata dei prodotti -->
        <div class="main_box" id="main_box">
            <!-- Box della card di un singolo prodotto -->
            <div id="card">
                <!-- Descrizione della card di un singolo prodotto (Titolo, Autore e Prezzo) -->
                <div class="description" id="description"></div>
                <!-- Bottoni della card di un singolo prodotto -->
                <div class="card_buttons" id="card_buttons"></div>
            </div>
        </div>
    </form>
</section>