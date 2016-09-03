<?php


session_start();
include_once 'Saradnik.php';

$page_title="Saradnik";//Predmet::nadjiIme();
include_once 'valicacija.php';
include_once 'templates/header.php';
include_once 'templates/left.php';
echo "<div class=\"col-6\">";

Saradnik::pisiSaradnika();





echo "</div>";
include_once 'templates/right.php';
include_once 'templates/footer.php';










?>