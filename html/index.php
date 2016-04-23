<!DOCTYPE html>
<html lang="de">
<!--
  Created by PhpStorm.
  User: MartinKuenzler
  Date: 14.03.16
  Time: 13:45

  Die Startseite des Bergrestaurants soll alle fünf Minuten das aktuellste Bild
  anzeigen. Über die Navigationsleiste kann der Benutzer ein neues
  Panorama erstellen alle Bilder, die älter als 14 Tage sind löschen und
  auch das Archiv besuchen.
  Dazu verwende ich Bootstrap.
-->
<!--
   Im Head befinden sich wichtige Infromationen wie zum Beispiel der Autor
   oder das Favicon und das Stylesheet.
 -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Martin Künzler">
    <link rel="icon" href="../imc/PF-Berg-Favicon.png">
    <title>Bergrestaurant IGE 13B</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="navbar navbar-inverse">
        <a class="navbar-brand" href="../html/index.php">
            Bergrestaurant Panorama
        </a>
        <a class="navbar-brand navbar-right" href="../src/deleteOldPhotos.php">
            Bilder löschen
        </a>
        <a class="navbar-brand navbar-right" href="../src/createPhoto.php">
            Panorama generieren
        </a>
        <a class="navbar-brand navbar-right" href="../src/showArchiv.php">
            Archiv Anzeigen
        </a>
    </div>
    <div class="jumbotron">
        <div class="container">
            <h1>Herzlich Willkommen beim Bergrestaurant IGE 13B </h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-md-11">
                <a class="thumbnail">
                    <?php
                    /**
                     * Druch dieses Script wir das überprüft, ob das enthaltene
                     * Foto dem Datum entspricht und auch ein Foto ist.
                     * Durch die Variabeln $datum und $datum1 stehen für das
                     * Datum und die Zeit vor fünf Minunten
                     *
                     */
                    $datum = date("dmYHi"); // das aktuelle Datum 170420161739
                    $datum1 = $datum - 5; // fünf Minuten in die Vergangenheit
                    $handle = opendir('../imc/aktuell/'); //öffnen des Ordners
                    /**
                     * Sollange es im Ordner eine Datei gibt erscheint dieses
                     * auf dem Bild und wird durch eine Überprüfung gesteuert
                     */
                    while (($file = readdir($handle)) !== false) {
                        if ($file != '.' &&
                            $file != '..' &&
                            $file < $datum . 'jpg' &&
                            $file > $datum1 . 'jpg'
                        ) {
                            echo '<img class="thumbnail" src="../imc/aktuell/'
                                . $file .
                                '" alt="Aktuelles Bild">';
                        }
                    }
                    closedir($handle); // der Ordner wird geschlossen
                    ?>
                </a>
            </div>
        </div>

        <hr>

        <footer>
            <p>
                &copy; 2016 Martin Künzler | IGE 13B
                <a href="http://www.gibm.ch">GIBM</a>
            </p>
        </footer>
    </div> <!-- /container -->
</div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
