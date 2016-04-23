<?php
/**
 * Created by PhpStorm.
 * User: MartinKuenzler
 * Date: 15.03.16
 * Time: 20:49
 */


require('../src/includes/connection.inc.php');

$camHandler = new camHandler();
$camHandler->loeschenVonBildern();
?>