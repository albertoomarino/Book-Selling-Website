<!--
   Laboratorio di Tecnologie WEB - Esercitazione 03
   Nome e Cognome: Alberto Marino
   Matricola: 948258
   Esercizio: Esercitazione 03
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>TMNT - Rancid Tomatoes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="movie.css" type="text/css" rel="stylesheet">
    <link href="https://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/rotten.gif" type="image/gif"
          rel="shortcut icon">
</head>
<body>

<?php
# Tale stringa contiene il film
$movie = $_GET["film"];
# Creo una list leggendo le righe dal file $movie/info.txt
list($name, $year, $percentage) = file("$movie/info.txt", FILE_IGNORE_NEW_LINES);
$overview = file("$movie/overview.txt", FILE_IGNORE_NEW_LINES);
?>

<div id="Banner">
    <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/banner.png" alt="Rancid Tomatoes">
</div>
<h1>
    <?= $name . " (" . $year . ")" ?>
</h1>
<div id="WithoutValidators">
    <div id="Right">
        <div>
            <!-- Cerco l'immagine overview -->
            <img src="<?= $movie ?>/overview.png" alt="General Overview">
        </div>
        <dl id="TextRightSide">
            <?php
            for ($i = 0; $i < count($overview); $i++) {
                $array = explode(":", $overview[$i]);
                ?>
                <dt> <?= $array[0] ?> </dt> <!-- Stampo termine -->
                <dd> <?= $array[1] ?> </dd> <!-- Stampo descrizione -->
                <?php
            }
            ?>
        </dl>
    </div>
    <div id="Left">
        <div id="Heading">
            <?php
            # Se il rating < 60%, mostro l'immagine "ROTTEN"
            if ($percentage < 60) {
                ?>
                <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rottenbig.png"
                     class="ThirtyThree" alt="Rotten">
                <?= $percentage . "%" ?>
                <?php
                # Se il rating >= 60%, mostro l'immagine "FRESH"
            } else if ($percentage >= 60) {
                ?>
                <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/freshbig.png"
                     class="ThirtyThree" alt="Fresh">
                <?= $percentage . "%" ?>
                <?php
            }
            ?>
        </div>
        <div id="CentreLeft">
            <?php
            # Lista dei file review*.txt nella cartella $movie/
            $file_review = glob("$movie/review*.txt");
            # Dimensione della lista
            $file_num = count($file_review);
            # Leggo la prima metà delle recensioni da inserire nella colonna di sinistra "CentreLeft"
            # Se numb_of_file è dispari con round si legge una recensione in più nella colonna di sinistra
            for ($i = 0; $i < round($file_num / 2); $i++) {
                $revw = $file_review[$i];
                $file_array = file($revw, FILE_IGNORE_NEW_LINES);
                list($review, $rating_img, $name, $publication) = $file_array;
                ?>
                <p class="SmallRectangle">
                    <?php
                    # Immagine valutazione
                    if ($rating_img == "ROTTEN") {
                        ?>
                        <img class="Profile"
                             src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif"
                             alt="Rotten"/>
                        <?php
                    } elseif ($rating_img == "FRESH") {
                        ?>
                        <img class="Profile"
                             src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/fresh.gif"
                             alt="Fresh"/>
                    <?php }
                    ?>
                    <!-- Testo recensione -->
                    <q> <?= $review ?> </q>
                </p>
                <p class="VerticalSpaceProfile">
                    <!-- Immagine recensore -->
                    <img class="Profile"
                         src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif"
                         alt="Critic"/>
                    <!-- Nome recensore e pubblicazione -->
                    <?php echo("$name <br> $publication ") ?>
                </p>
            <?php } ?>
        </div>
        <div id="CentreRight">
            <?php
            for ($i; $i < $file_num; $i++) {
                $revw = $file_review[$i];
                $file_array = file($revw, FILE_IGNORE_NEW_LINES);
                list($review, $rating_img, $name, $publication) = $file_array;
                ?>
                <p class="SmallRectangle">
                    <?php
                    # Immagine valutazione
                    if ($rating_img == "ROTTEN") {
                        ?>
                        <img class="Profile"
                             src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif"
                             alt="Rotten"/>
                        <?php
                    } elseif ($rating_img == "FRESH") {
                        ?>
                        <img class="Profile"
                             src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/fresh.gif"
                             alt="Fresh"/>
                        <?php
                    }
                    ?>
                    <!-- Testo recensione -->
                    <q> <?= $review ?> </q>
                </p>
                <p class="VerticalSpaceProfile">
                    <!-- Immagine recensore -->
                    <img class="Profile"
                         src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif"
                         alt="Critic"/>
                    <!-- Nome recensore e pubblicazione -->
                    <?php
                    echo("$name <br> $publication ")
                    ?>
                </p>
                <?php
            }
            ?>
        </div>
    </div>

    <div id="Footer">
        (1-<?= count($file_review) ?>) of <?= count($file_review) ?>
    </div>
</div>
<div id="Validators">
    <p>
        <a href="http://validator.w3.org/check/referer"><img width="88"
                                                             src="https://upload.wikimedia.org/wikipedia/commons/b/bb/W3C_HTML5_certified.png"
                                                             alt="Valid HTML5!"></a>
    <p><br>
        <a href="http://jigsaw.w3.org/css-validator/check/referer"><img
                    src="http://jigsaw.w3.org/css-validator/images/vcss"
                    alt="Valid CSS!"></a>
</div>
</body>
</html>
