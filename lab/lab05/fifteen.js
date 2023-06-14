/**
 * Laboratorio di Tecnologie WEB - Esercitazione 05
 * Nome e Cognome: Alberto Marino
 * Matricola: 948258
 * Esercizio: Esercitazione 05
 */

var columns = 4;
var cells = 90;
var borders = 5;
var emptyCellX = 3;
var emptyCellY = 3;

/* Costruzione del puzzle */
window.onload = function () {
    var puzzle = $("puzzlearea").childElements();
    var numCell = 0;
    var sixteenthCell = document.createElement("div"); /* sixteenthCell: cella vuota */
    sixteenthCell.setAttribute('id', "empty");
    $("puzzlearea").appendChild(sixteenthCell);
    for (var i = 0; i < columns; i++) {
        for (var j = 0; j < columns; j++) {
            var y = -(i * cells + borders);
            var x = -(j * cells + borders);
            if (numCell < puzzle.length) {
                puzzle[numCell].style.backgroundPosition = x + "px " + y + "px";
                puzzle[numCell].setAttribute('id', "cell_" + i + "_" + j);
                puzzle[numCell].observe("click", clickMovement);
                puzzle[numCell].observe("mouseover", mouseMovement);
                numCell++;
            }
        }
    }
    $("shufflebutton").observe("click", shuffle);
};

/* Verifica se la sezione può essere spostata */
function mouseMovement() {
    if (verifyMovement(this.id)) { /* Se la sezione può essere spostata, allora occorre evidenziarla in rosso */
        $(this.id).addClassName("b");
    } else {
        $(this.id).removeClassName("b"); /* Se la sezione non può essere spostata, allora non bisogna evidenziarla in rosso */
    }
}

/* Verifica se la sezione può essere spostata */
function verifyMovement(string) {
    var puzzle = string.split("_");
    var x = parseInt(puzzle[1]);
    var y = parseInt(puzzle[2]);
    if (emptyCellX == x) {
        if ((emptyCellY - 1) == y || (emptyCellY + 1) == y) {
            return true;
        }
    } else if (emptyCellY == y) {
        if ((emptyCellX - 1) == x || (emptyCellX + 1) == x) {
            return true;
        }
    }
}

function clickMovement(event) {
    movimento(this.id);
}

/* Spostamento delle sezioni */
function movimento(string) {
    if (verifyMovement(string)) {
        var num = $(string).innerHTML;
        var puzzle = $(string).id.split("_");
        var x = parseInt(puzzle[1]);
        var y = parseInt(puzzle[2]);
        var New = $(string);
        var last = $("empty");
        last.style.backgroundPosition = New.style.backgroundPosition;
        last.innerHTML = New.innerHTML;
        last.id = "cell_" + emptyCellX + "_" + emptyCellY;
        last.observe("mouseover", mouseMovement);
        last.observe("click", clickMovement);
        New.id = "empty";
        New.innerHTML = "";
        New.removeClassName("b");
        New.removeAttribute("style");
        New.stopObserving("mouseover", mouseMovement);
        New.stopObserving("click", clickMovement);
        New.stopObserving("mouseover", mouseMovement);
        New.stopObserving("click", clickMovement);
        emptyCellX = x;
        emptyCellY = y;
    }
}

/* Shuffle delle sezioni */
function shuffle() {
    for (var k = 1; k < 50; k++) {
        var array = [];
        for (var i = 0; i < columns; i++) {
            for (var j = 0; j < columns; j++) {
                var nome = "cell_" + i + "_" + j;
                if (verifyMovement(nome)) {
                    array.push(nome);
                }
            }
        }
        movimento(array[parseInt(Math.random() * array.length)]);
    }
}
