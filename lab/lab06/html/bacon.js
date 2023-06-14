/**
 * Laboratorio di Tecnologie WEB - Esercitazione 06
 * Nome e Cognome: Alberto Marino
 * Matricola: 948258
 * Esercizio: Esercitazione 06
 */

$(function () { // Caricamento della pagina
    $("#results").hide();

    $("#searchall :submit").click(function () { // Vengono cercati i film di un attore alla pressione del button
        $.ajax({
            url: "getMovieList.php",
            type: "GET",
            datatype: "json",
            data: "firstname=" + $("#searchall [name=firstname]").val() +
                "&lastname=" + $("#searchall [name=lastname]").val() +
                "&all=true",
            success: showAllActors,
            error: ajaxFailed
        });
    });

    $("#searchkevin [type=submit]").click(function () { // Vengono cercati i film di Kevin Bacon alla pressione del button
        $.ajax({
            url: "getMovieList.php",
            type: "GET",
            datatype: "json",
            data: "firstname=" + $("#searchkevin [name=firstname]").val() +
                "&lastname=" + $("#searchkevin [name=lastname]").val() +
                "&all=false",
            success: showKevinActors,
            error: ajaxFailed
        });
    });

    function showAllActors(result) { // Funzione di callback quando la chiamata ajax funziona
        $("p").hide(); // Nascondo tutti i <p>
        $("h1").first().hide(); // Nascondo il primo <h1>
        $("#errMsg").hide(); // Nascondo il div dell'errore
        if (!result.toString().length) { // Se non ho la lunghezza (header) allora la query non ha prodotto risultati
            $(".lis").remove(); // Rimuovo la classe lis per pulire lo schermo ad un'altra esecuzione
            $("h1").hide(); // Nascondo <h1>
            $("#errMsg").show(); // Mostro div dell'errorre
            $("#errMsg").append('<p> Actor ' + $("#searchall [name=firstname]").val() + ' ' + $("#searchall [name=lastname]").val() + ' not found </p>');
        } else {
            $("#results").show(); // Mostro il div results
            $("h1").last().show();
            $(".lis").remove(); // Rimuovo la classe lis per pulire lo schermo
            $("#firstN").text($("#searchall [name=firstname]").val());
            $("#lastN").text($("#searchall [name=lastname]").val());

            var i = 0;
            result.forEach(function (lista) {
                i++; // Stampa della tabella
                $("#list").append('<tr class="lis"><td>' + i +
                    "</td><td>" + lista.name +
                    "</td><td>" + lista.year +
                    "</td></tr>");
            });
        }
    }

    function showKevinActors(result) { // Funzione di callback quando la chiamata ajax funziona
        $("p").hide(); // Nascondo tutti i <p>
        $("h1").first().hide(); // Nascondo il primo <h1>
        $("#errMsg").hide(); // Nascondo il div dell'errore
        if (!result.toString().length) { // Se non ho la lunghezza (header) allora la query non ha prodotto risultati
            $(".lis").remove(); // Rimuovo la classe lis per pulire lo schermo ad un'altra esecuzione
            $("h1").hide(); // Nascondo <h1>
            $("#errMsg").show(); // Mostro div dell'errorre
            $("#errMsg").append('<p> Actor ' + $("#searchkevin [name=firstname]").val() + ' ' + $("#searchkevin [name=lastname]").val() + ' not found or wasn t in any films with Kevin Bacon. </p>');
        } else {
            $("#results").show(); // Mostro (dopo averlo nascosto) il div results
            $("h1").last().show();
            $(".lis").remove(); // Rimuovo la classe lis per pulire lo schermo ad un'altra esecuzione
            $("#firstN").text($("#searchkevin [name=firstname]").val());
            $("#lastN").text($("#searchkevin [name=lastname]").val());

            var i = 0;
            result.forEach(function (lista) {
                i++; // Stampa della tabella
                $("#list").append('<tr class="lis"><td>' + i +
                    "</td><td>" + lista.name +
                    "</td><td>" + lista.year +
                    "</td></tr>");
            });
        }
    }

    function ajaxFailed(e) { // Funzione di callback quando la chiamata ajax non funziona
        var errmessage = "Error making Ajax request:\n\n";

        errmessage += "Server status: \n" + e.status + "" + e.statusText
            + "\n\nServer response text:\n" + e.responseText;

        alert(errmessage);
    }
});
