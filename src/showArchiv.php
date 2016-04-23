<?php
/**
 * Created by PhpStorm.
 * User: MartinKuenzler
 * Date: 15.03.16
 * Time: 20:49
 */
require('../src/includes/connection.inc.php');

?>
<!DOCTYPE html>
<html lang="de">
<!--
  Created by PhpStorm.
  User: MartinKuenzler
  Date: 14.03.16
  Time: 13:45

  Der Menüpunkt Archiv Anzeigen ermöglicht es dem Benutzer alle alten Bilder
  des Panoramas anzuzeigen.
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
            <h1>Archiv</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <hr>
            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <?php
                    $camHandler = new camHandler();
                    $camHandler->archivAnzeigen();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2016 Martin Künzler | IGE 13B <a href="http://www.gibm.ch">GIBM</a></p>
    </footer>
</div> <!-- /container -->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>

