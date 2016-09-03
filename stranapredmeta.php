<?php



session_start();
include_once 'Predmet.php';

$page_title=Predmet::nadjiIme();
include_once 'valicacija.php';
include_once 'templates/header.php';
include_once 'templates/left.php';
echo "<div class=\"col-6\">";

Predmet::pisiPredmet();





echo "</div>";
include_once 'templates/right.php';
include_once 'templates/footer.php';
?>