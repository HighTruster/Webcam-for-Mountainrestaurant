<?php
/**
 * Created by PhpStorm.
 * User: MartinKuenzler
 * Date: 14.03.16
 * Time: 13:43
 *
 * Wir erstellen mit der Hilfe von
 *
 */
header("Content-type: image/jpg");
require('../src/includes/connection.inc.php');
$camHandler = new camHandler();
$camHandler->erstellenFoto();
?>