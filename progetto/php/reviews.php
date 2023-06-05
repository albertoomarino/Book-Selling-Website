<?php
// Se non è presente una sessione, viene creata
if (!isset($_SESSION)) {
    session_start();
}
?>

<section class="reviews" id="reviews">
    <form class="reviews_form">
        <h1 class="heading">Customer reviews</h1>
        <?php
        if ($_SESSION["role"] === "admin") {
            ?>
            <div id="insert_and_remove">
                <a href="insert_review.php" id="insert_review_button">Add a new review</a>
                <a href="remove_review.php" id="remove_review_button">Remove a review</a>
            </div>
            <?php
        } else {
            ?>
            <div id="insert_and_remove">
                <a href="insert_review.php" id="insert_review_button">Add a new review</a>
            </div>
            <?php
        }
        ?>
        <!-- Paragrafo per mostrare il messaggio nel caso in cui non ci siano recensioni -->
        <p id="empty_reviews"></p>
        <!-- Box dell'intera schermata dei prodotti -->
        <div class="main_box" id="main_box">
            <!-- Box della card di un singolo prodotto -->
            <div id="review_card">
                <!-- Username dell'utente che ha scritto una singola recensione -->
                <div class="review" id="review"></div>
            </div>
        </div>
    </form>
</section>