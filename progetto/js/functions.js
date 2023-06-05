/**
 * Funzione che mostra/nasconde la password in fase di login e registrazione
 */
function show_hide_psw() {
    const x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

/**
 * Codice relativo alla pagina "subscribe.php"
 */
$(document).ready(function () {
    $("#subscribe_form").submit(function (e) {
        let form = $(this);
        e.preventDefault();
        $.ajax({
            url: "../php/functions.php",
            type: "POST",
            data: form.serialize() + "&to_do=user_subscribe",
            success: function (response) {
                // Se la query di inserimento dell'utente va a buon fine, si va alla homepage
                if (response.substring(1, 0) === "1") {
                    window.location.href = "../php/home.php";
                } else {
                    window.location.href = "../php/subscribe.php";
                }
            },
            error: ajaxFailed,
        });
    });
});

/**
 * Codice relativo alla pagina "login.php"
 */
$(document).ready(function () {
    $("#login_form").submit(function (e) {
        let form = $(this);
        e.preventDefault();
        $.ajax({
            url: "../php/functions.php",
            type: "POST",
            data: form.serialize() + "&to_do=user_login",
            success: function (response) {
                // Se la query di ricerca dell'utente va a buon fine, si va alla homepage
                if (response.substring(1, 0) === "1") {
                    window.location.href = "../php/home.php";
                } else {
                    window.location.href = "../php/login.php";
                }
            },
            error: ajaxFailed,
        });
    });
});

/**
 * Codice relativo alla funzione "show_uploaded_book"
 */
$(document).ready(function () {
    $.ajax({
        url: "../php/functions.php",
        type: "POST",
        datatype: "json",
        data: {
            to_do: "show_uploaded_book",
        },
        success: function (response) {
            let data = response;
            // Se non ci sono prodotti in vendita, viene mostrato il messaggio
            if (data.length === 0) {
                $("#empty_insert_db").append(
                    "<p id='empty_insert_db'>There are no books for sale at the moment!</p>"
                );
            } else {
                // Se ci sono prodotti in vendita, essi vengono inseriti in una scheda e mostrati all'utente
                for (let i in data) {
                    // Crea una scheda del libro
                    $("#card").append(
                        "<div class='card'>" +

                        // Immagine della card
                        "<img src='" + data[i].image + "' alt='Foto'>" +

                        // Titolo, autore e prezzo del libro presente nella card
                        "<div class='description'>" +
                        "<p id='book_title' title=\"Book's title\">" + data[i].title + "</p>" +
                        "<p id='book_author' title=\"Author(s) of the book\"><span id='descr_book'>written by </span>" + data[i].author + "</p>" +
                        "<p id='book_price' title=\"Book's price\">" + data[i].price.toFixed(2) + " €</p>" +
                        "</div>" +

                        // Tasti per aggiungere il prodotto al carrello e per visualizzarlo
                        "<div class='card_buttons'>" +
                        "<a class='add_to_basket' id='add_to_basket'>Add to basket</a>" +
                        "</div>" +
                        "</div>"
                    );

                    // Aggiungi il listener di eventi click per il bottone "Add to basket"
                    $("#card .card:last-child .add_to_basket").click(function () {
                        const book_title = $(this).closest(".card").find("#book_title").text();
                        // Salva il valore del titolo del libro in una variabile globale
                        window.selectedBookTitle = book_title;
                        // Aggiungi il prodotto al carrello
                        add_to_basket(book_title);
                    });
                }
            }
        },
        error: ajaxFailed,
    });
});

/**
 * Codice relativo alla funzione "upload_book"
 */
$(document).ready(function () {
    $("#insert_book_form").submit(function (e) {
        let form = $(this);
        e.preventDefault();
        $.ajax({
            url: "../php/functions.php",
            type: "POST",
            data: form.serialize() + "&to_do=upload_book",
            success: function (response) {
                // In funzione dell'esito del tentativo di inserimento del prodotto, stampa il relativo messaggio
                if (response.substring(1, 0) === "1") {
                    $(".new_book_input_price").append(
                        "<p id='book_success'>The book has been successfully added!</p>"
                    );

                    // Logica per far scomparire il messaggio dopo 1.5 secondi
                    setTimeout(function () {
                        $("#book_success").fadeOut(1500, function () {
                            $(this).remove();
                            location.reload(); // Aggiorna la pagina
                        });
                    }, 1500);
                } else {
                    $(".new_book_input_price").append(
                        "<p id='book_fail'>The book is already on the website!</p>"
                    );

                    // Logica per far scomparire il messaggio dopo 1.5 secondi
                    setTimeout(function () {
                        $("#book_fail").fadeOut(1500, function () {
                            $(this).remove();
                        });
                    }, 1500);
                }
            },
            error: ajaxFailed,
        });
    });
});

/**
 * Codice relativo alla funzione "show_removed_book"
 */
$(document).ready(function () {
    $.ajax({
        url: "../php/functions.php",
        type: "POST",
        datatype: "json",
        data: {
            to_do: "show_removed_book",
        },
        success: function (response) {
            let data = response;
            // Se non ci sono prodotti in vendita, nascondo la section e viene mostrato il messaggio
            if (data.length === 0) {
                $("#select_remove").hide();
                $("#empty_remove_db").append(
                    "<p id='empty_remove_db'>There are no books for sale at the moment!</p>"
                );
            } else {
                let i;
                // Se ci sono prodotti in vendita, essi vengono inseriti in una scheda e mostrati all'utente
                for (i in data) {
                    $('#select_remove').append(
                        // Gestisco gli elementi "option" del menù a tendina "section"
                        "<option>" + data[i].title + "</option>"
                    );
                }
            }
        },
        error: ajaxFailed,
    });
});

/**
 * Codice relativo alla funzione "remove_book"
 */
$(document).ready(function () {
    $("#remove_book_form").submit(function (e) {
        let form = $(this);
        e.preventDefault();
        $.ajax({
            url: "../php/functions.php",
            type: "POST",
            data: form.serialize() + "&to_do=remove_book",
            success: function (response) {
                // In funzione dell'esito del tentativo di rimozione del prodotto, stampa il relativo messaggio
                if (response.substring(1, 0) === "0") {
                    $(".remove_book_advise").append(
                        "<p id='book_success'>The book has been successfully removed!</p>"
                    );

                    // Logica per far scomparire il messaggio dopo 1.5 secondi
                    setTimeout(function () {
                        $("#book_success").fadeOut(1500, function () {
                            $(this).remove();
                            location.reload(); // Ricarica la pagina
                        });
                    }, 1500);
                } else {
                    $(".remove_book_advise").append(
                        "<p id='book_fail'>The book was not removed correctly!</p>"
                    );

                    // Logica per far scomparire il messaggio dopo 1.5 secondi
                    setTimeout(function () {
                        $("#book_fail").fadeOut(1500, function () {
                            $(this).remove();
                        });
                    }, 1500);
                }
            },
            error: ajaxFailed,
        });
    });
});

/**
 * Codice relativo alla funzione "show_description_book"
 */
$(document).ready(function () {
    $.ajax({
        url: "../php/functions.php",
        type: "POST",
        datatype: "json",
        data: {
            to_do: "show_description_book",
        },
        success: function (response) {
            let data = response;
            let i;
            for (i in data) {
                $("#selected_book").append(
                    "<div class='selected_book'>" +
                    // Immagine del prodotto
                    "<div class='img_selected_book'>" +
                    "<img id='descr_img' src='" + data[i].image + "' alt='Foto'>" +
                    "</div>" +

                    // Titolo, autore, prezzo, editore e trama del libro
                    "<div class='description_selected_book'>" +
                    '<p id="descr_title" title="Book\'s title">' + "<span id='descr'>Book's title:</span>" + " " + data[i].title + "</p>" +
                    '<p id="descr_author" title="Author(s) of the book">' + "<span id='descr'>Author(s) of the book:</span>" + " " + data[i].author + "</p>" +
                    "<p id='descr_price' title=\"Book's price\">" + "<span id='descr'>Book's price:</span>" + " " + data[i].price.toFixed(2) + " €" + "</p>" +
                    '<p id="descr_publisher" title=\"Book\'s publisher\">' + "<span id='descr'>Book's publisher:</span>" + " " + data[i].publisher + "</p>" +
                    '<p id="descr_plot" title=\"Book\'s plot\">' + "<span id='descr'>Book's plot:</span><i id='plot'>" + " " + data[i].plot + "</i></p>" +
                    "</div>" +

                    "</div>"
                );
            }
        },
        error: ajaxFailed,
    });
});

/**
 * Codice relativo alla funzione "show_basket"
 */
$(document).ready(function () {
    $.ajax({
        url: "../php/functions.php",
        type: "POST",
        datatype: "json",
        data: {
            to_do: "show_basket",
        },
        success: function (response) {
            let data = response;
            // Se non ci sono prodotti in vendita, viene mostrato il messaggio
            if (data.length === 0) {
                $("#empty_basket").append(
                    "<p id='empty_basket'>There are no books in your shopping cart at the moment!</p>"
                );
                $("#complete_order_button").hide(); // Nasconde il bottone "Complete order"
            } else {
                let tot_basket_price = 0;
                let i;

                // Se ci sono prodotti in vendita, essi vengono inseriti in una scheda e mostrati all'utente
                for (i in data) {
                    let book_price = parseFloat(data[i].price);
                    tot_basket_price += book_price;
                    $("#basket_book_box").append(
                        "<div class='basket_card'>" +

                        // Immagine del prodotto
                        "<div class='basket_card_img'>" +
                        "<img src='" + data[i].image + "' alt='Foto'>" +
                        "</div>" +

                        // Titolo e prezzo del prodotto
                        "<div class='description_box_book'>" +
                        '<p id="basket_book_title" title="Book\'s title">' + data[i].title + "</p>" +
                        '<p id="basket_book_author" title="Author(s) of the book">' + "<span id='descr_book'>written by </span>" + data[i].author + "</p>" +
                        "<p class='basket_book_price' id='basket_book_price' title=\"Book's price\">" + data[i].price.toFixed(2) + " €" + "</p>" +

                        // Tasti per aumentare e diminuire la quantità
                        "<div class='quantity_buttons'>" +
                        "<p class='quantity_name' title=\"Book's quantity\">Quantity: </p>" +
                        "<button class='quantity_decrease'>-</button>" +
                        "<p class='quantity' data-quantity='1'>1</p>" +
                        "<button class='quantity_increase'>+</button>" +
                        "</div>" +
                        "</div>" +
                        "</div>"
                    );
                }

                // Visualizzazione del prezzo totale dell'ordine
                $("#total_basket_price").append(
                    "<p id='total_basket_price'>Total price: " + tot_basket_price.toFixed(2) + " €" + "</p>"
                );

                // Aggiunta del bottone "Complete order"
                $("#basket_book_box").after(
                    "<button id='complete_order_button' class='complete_order_button' href='#'>Click here to complete your order</button>"
                );

                // Aggiunta dell'animazione al click del bottone per il completamento dell'ordine
                $("#complete_order_button").click(function () {
                    $(this).addClass("animate_button").animate({opacity: 0}, 500, function () {
                        $(this).html("<span class='checkmark'></span> Thank you, order completed!").animate({opacity: 1}, 500);
                    });
                });

                complete_order();

                // Assegna gli eventi di click alle funzioni di incremento e decremento
                // Le classi "quantity_increase" e "quantity_decrease" sono le classi relative ai bottoni "-" e "+"
                $("#basket_book_box").on("click", ".quantity_increase", increment_price);
                $("#basket_book_box").on("click", ".quantity_decrease", decrement_price);
            }
        },
        error: ajaxFailed,
    });
});


/**
 * Funzione che decrementa il prezzo totale del carrello
 */
function decrement_price() {
    // Trova l'elemento della quantità corrispondente al pulsante di decremento
    const quantityElement = $(this).siblings(".quantity");
    // Ottiene il valore della quantità come un intero utilizzando il metodo "parseInt()"
    let quantity = parseInt(quantityElement.data("quantity"));
    // Se la quantità è almeno maggiore di 1, decrementa
    if (quantity > 1) {
        quantity -= 1;
        // Aggiorna il valore della quantità nell'elemento utilizzando il metodo
        quantityElement.data("quantity", quantity);
        // Aggiorna il testo dell'elemento della quantità con il nuovo valore
        quantityElement.text(quantity);
        // Trova l'elemento del prezzo corrispondente alla carta del carrello
        const priceElement = $(this).closest(".basket_card").find(".basket_book_price");
        // Ottiene il valore del prezzo come un numero decimale utilizzando il metodo "parseFloat()" e rimuove il simbolo "€"
        const price = parseFloat(priceElement.text().replace(" €", ""));
        // Trova l'elemento del prezzo totale
        const totalPriceElement = $("#total_basket_price");
        // Ottiene il valore del prezzo totale come un numero decimale utilizzando il metodo "parseFloat()" e rimuove il testo "Total price: " e il simbolo "€"
        let totalPrice = parseFloat(totalPriceElement.text().replace("Total price: ", "").replace(" €", ""));
        // Sottrae il prezzo dell'elemento dalla variabile del prezzo totale
        totalPrice -= price;
        // Aggiorna il testo dell'elemento del prezzo totale con il nuovo valore
        totalPriceElement.text("Total price: " + totalPrice.toFixed(2) + " €");
    }
}

/**
 * Funzione che incrementa il prezzo totale del carrello
 */
function increment_price() {
    // Trova l'elemento della quantità corrispondente al pulsante di incremento
    const quantityElement = $(this).siblings(".quantity");
    // Ottiene il valore della quantità come un intero
    let quantity = parseInt(quantityElement.data("quantity"));
    // Incrementa la quantità di 1
    quantity += 1;
    // Aggiorna il valore della quantità nell'elemento
    quantityElement.data("quantity", quantity);
    // Aggiorna il testo dell'elemento della quantità con il nuovo valore
    quantityElement.text(quantity);
    // Trova l'elemento del prezzo corrispondente alla carta del carrello
    const priceElement = $(this).closest(".basket_card").find(".basket_book_price");
    // Ottiene il valore del prezzo come un numero decimale e rimuove il simbolo "€"
    const price = parseFloat(priceElement.text().replace(" €", ""));
    // Trova l'elemento del prezzo totale
    const totalPriceElement = $("#total_basket_price");
    // Ottiene il valore del prezzo totale come un numero decimale utilizzando il metodo "parseFloat()" e rimuove il testo "Total price: " e il simbolo "€"
    let totalPrice = parseFloat(totalPriceElement.text().replace("Total price: ", "").replace(" €", ""));
    // Aggiunge il prezzo dell'elemento alla variabile del prezzo totale
    totalPrice += price;
    // Aggiorna il testo dell'elemento del prezzo totale con il nuovo valore
    totalPriceElement.text("Total price: " + totalPrice.toFixed(2) + " €");
}

/**
 * Funzione che gestisce l'esito dell'inserimento del prodotto nel carrello
 *
 * @param title
 */
function add_to_basket(title) {
    // Logica per aggiungere il prodotto al carrello
    $(document).ready(function () {
        $.ajax({
            url: "../php/functions.php",
            type: "POST",
            datatype: "json",
            data: {
                to_do: "upload_to_basket",
                title: title // Titolo del libro come parte dei dati inviati
            },
            success: function (response) {
                // In funzione dell'esito del tentativo di inserimento del prodotto, stampa il relativo messaggio
                if (response.substring(1, 0) === "1") {
                    $(".add_to_basket").each(function () {
                        if ($(this).closest(".card").find("#book_title").text() === title) {
                            $(this)
                                .addClass("animate_button")
                                .animate({opacity: 0}, 500, function () {
                                    $(this)
                                        .html("<span class='checkmark'></span> Added!")
                                        .animate({opacity: 1}, 500);
                                });
                        }
                    });
                } else {
                    $(".add_to_basket").each(function () {
                        if ($(this).closest(".card").find("#book_title").text() === title) {
                            $(this)
                                .addClass("animate_button")
                                .animate({opacity: 0}, 500, function () {
                                    $(this)
                                        .html("<span class='checkmark_red'></span> Already added!")
                                        .animate({opacity: 1}, 500);
                                });
                        }
                    });
                }
            },
            error: ajaxFailed,
        });
    });
}

/**
 * Codice relativo alla funzione "show_removed_book_from_basket"
 */
$(document).ready(function () {
    $.ajax({
        url: "../php/functions.php",
        type: "POST",
        datatype: "json",
        data: {
            to_do: "show_removed_book_from_basket",
        },
        success: function (response) {
            let data = response;
            // Se non ci sono prodotti in vendita, nascondo la section e viene mostrato il messaggio
            if (data.length === 0) {
                $("#remove_book_from_basket").hide();
                $("#select_remove_from_basket").hide();
                $("#empty_remove_from_basket_db").append(
                    "<p id='empty_remove_from_basket_db'>There are no books in your shopping cart at the moment!</p>"
                );
                $("#remove_book_from_basket_button").hide(); // Nasconde il bottone "Complete order"
            } else {
                let i;
                // Se ci sono prodotti in vendita, essi vengono inseriti in una scheda e mostrati all'utente
                for (i in data) {
                    $('#select_remove_from_basket').append(
                        // Gestisco gli elementi "option" del menù a tendina "section"
                        "<option>" + data[i].title + "</option>"
                    );
                }
            }
        },
        error: ajaxFailed,
    });
});

/**
 * Codice relativo alla funzione "remove_book_from_basket"
 */
$(document).ready(function () {
    $("#remove_book_from_basket_form").submit(function (e) {
        let form = $(this);
        e.preventDefault();
        $.ajax({
            url: "../php/functions.php",
            type: "POST",
            data: form.serialize() + "&to_do=remove_book_from_basket",
            success: function (response) {
                // In funzione dell'esito del tentativo di rimozione del prodotto, stampa il relativo messaggio
                if (response.substring(1, 0) === "0") {
                    $(".remove_book_from_basket_advise").append(
                        "<p id='book_success'>The book has been successfully removed from your shopping basket!</p>"
                    );

                    // Logica per far scomparire il messaggio dopo 1.5 secondi
                    setTimeout(function () {
                        $("#book_success").fadeOut(1500, function () {
                            $(this).remove();
                            location.reload(); // Aggiorna la pagina
                        });
                    }, 1500);
                } else {
                    $(".remove_book_from_basket_advise").append(
                        "<p id='book_fail'>The book was not removed correctly from your shopping basket!</p>"
                    );

                    // Logica per far scomparire il messaggio dopo 1.5 secondi
                    setTimeout(function () {
                        $("#book_fail").fadeOut(1500, function () {
                            $(this).remove();
                        });
                    }, 1500);
                }
            },
            error: ajaxFailed,
        });
    });
});

/**
 * Funzione che gestisce l'esito del completamento dell'ordine al momento del check-out
 */
function complete_order() {
    $(document).ready(function () {
        $("#complete_order_button").click(function () {
            $.ajax({
                url: "../php/functions.php",
                type: "POST",
                data: {
                    to_do: "complete_order"
                },
                success: function (response) {
                    // In funzione dell'esito del tentativo di inserimento del prodotto, stampa il relativo messaggio
                    if (response.substring(1, 0) === "1") {
                        // Aggiorna la pagina dopo 3 secondi
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    }
                },
                error: ajaxFailed,
            });
        });
    });
}

/**
 * Codice relativo alla funzione "show_reviews"
 */
$(document).ready(function () {
    $.ajax({
        url: "../php/functions.php",
        type: "POST",
        datatype: "json",
        data: {
            to_do: "show_reviews",
        },
        success: function (response) {
            let data = response;
            // Se non ci sono recensioni, viene mostrato il messaggio
            if (data.length === 0) {
                $("#remove_review_form").hide();
                $("#empty_reviews").append(
                    "<p id='empty_reviews'>There are no reviews at the moment!</p>"
                );
            } else {
                let i;
                // Se ci sono recensioni, esse vengono mostrate all'utente
                for (i in data) {
                    $("#review_card").append(
                        "<div class='review_card'>" +
                        "<div class='review'>" +
                        // Username dell'utente che ha scritto la recensione e titolo del libro
                        "<p id='review'>Review by <span id='review_elements'>" + data[i].username + "</span> regarding the book <span id='review_elements'>" + data[i].title + "</span></p>" +

                        // Testo della recensione
                        '<p id="review_text">"' + data[i].text + '"</p>' +
                        "</div>" +

                        "</div>"
                    );
                }
            }
        },
        error: ajaxFailed,
    });
});

/**
 * Codice relativo alla funzione "upload_review"
 */
$(document).ready(function () {
    $("#insert_review_form").submit(function (e) {
        let form = $(this);
        e.preventDefault();
        $.ajax({
            url: "../php/functions.php",
            type: "POST",
            data: form.serialize() + "&to_do=upload_review",
            success: function (response) {
                console.log(response);
                // In funzione dell'esito del tentativo di inserimento del prodotto, stampa il relativo messaggio
                if (response.substring(0, 1) === "1") {
                    $(".new_review_input").append(
                        "<p id='book_success'>The review has been successfully added!</p>"
                    );

                    // Logica per far scomparire il messaggio dopo 1.5 secondi
                    setTimeout(function () {
                        $("#book_success").fadeOut(1500, function () {
                            $(this).remove();
                            location.reload(); // Aggiorna la pagina
                        });
                    }, 1500);
                } else {
                    $(".new_review_input").append(
                        "<p id='book_fail'>The review has not been added successfully!</p>"
                    );

                    // Logica per far scomparire il messaggio dopo 1.5 secondi
                    setTimeout(function () {
                        $("#book_fail").fadeOut(1500, function () {
                            $(this).remove();
                        });
                    }, 1500);
                }
            },
            error: ajaxFailed,
        });
    });
});

/**
 * Codice relativo alla funzione "remove_review"
 */
$(document).ready(function () {
    $("#remove_review_form").submit(function (e) {
        let form = $(this);
        e.preventDefault();
        $.ajax({
            url: "../php/functions.php",
            type: "POST",
            data: form.serialize() + "&to_do=remove_review",
            success: function (response) {
                // In funzione dell'esito del tentativo di rimozione del prodotto, stampa il relativo messaggio
                if (response.substring(1, 0) === "0") {
                    $(".remove_review_advise").append(
                        "<p id='book_success'>The review has been successfully removed!</p>"
                    );

                    // Logica per far scomparire il messaggio dopo 1.5 secondi
                    setTimeout(function () {
                        $("#book_success").fadeOut(1500, function () {
                            $(this).remove();
                            location.reload(); // Ricarica la pagina
                        });
                    }, 1500);
                } else {
                    $(".remove_review_advise").append(
                        "<p id='book_fail'>The review was not removed correctly!</p>"
                    );

                    // Logica per far scomparire il messaggio dopo 1.5 secondi
                    setTimeout(function () {
                        $("#book_fail").fadeOut(1500, function () {
                            $(this).remove();
                        });
                    }, 1500);
                }
            },
            error: ajaxFailed,
        });
    });
});

/**
 * Codice relativo alla funzione "show_removed_reviews"
 */
$(document).ready(function () {
    $.ajax({
        url: "../php/functions.php",
        type: "POST",
        datatype: "json",
        data: {
            to_do: "show_removed_reviews",
        },
        success: function (response) {
            let data = response;
            // Se non ci sono prodotti in vendita, nascondo la section e viene mostrato il messaggio
            if (data.length === 0) {
                $("#select_remove_review").hide();
            } else {
                let i;
                // Se ci sono prodotti in vendita, essi vengono inseriti in una scheda e mostrati all'utente
                for (i in data) {
                    $('#select_remove_review').append(
                        // Gestisco gli elementi "option" del menù a tendina "section"
                        "<option>" + data[i].username + ", " + data[i].title + "</option>"
                    );
                }
            }
        },
        error: ajaxFailed,
    });
});

/**
 * Funzione che gestisce l'animazione presente nella sezione "Contact us"
 * al momento dell'invio del messaggio
 */
$(document).ready(function () {
    $("#send_message").click(function (event) {
        event.preventDefault(); // Evita il comportamento di default del pulsante

        // Verifica se i campi del form sono stati riempiti
        if ($("input").val() !== "" && $("textarea").val() !== "") {
            $(this).addClass("animate_button");
            $(this).html("<span class='checkmark'></span> Thanks for the feedback!");

            // Resetta i campi del form dopo 2 secondi
            setTimeout(function () {
                $("input").val("");
                $("textarea").val("");

                // Torna a mostrare il bottone "Send message" gradualmente
                $("#send_message").animate({opacity: 0}, 1500, function () {
                    $(this).text("Send message").animate({opacity: 1}, 1500);
                });

                // Rimuovi l'animazione dopo 3 secondi
                setTimeout(function () {
                    $("#send_message").removeClass("animate_button");
                }, 3000);
            }, 2000);
        }
    });
});

/**
 * Funzione che definisce il comportamento in caso di errore della funzione AJAX
 *
 * @param e
 */
function ajaxFailed(e) {
    let error = "AJAX request error!\n";
    error += "Server status: " + e.status + "" + e.statusText + "\n\nServer response text:\n" + e.responseText;
    console.log(error);
}