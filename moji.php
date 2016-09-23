<?php


session_start();



require_once "Saradnik.php";
require_once "Predmet.php";
$page_title="Moji predmeti";
include_once 'valicacija.php';
include_once 'templates/header.php';
include_once 'templates/left.php';
echo "<div class=\"col-6\">";

    echo "<h3>".$page_title."</h3>";
echo '<section id="sadrzaj"><br><br><br>';

if(isset($_SESSION['idKorisnik'])){

    $saradnik=$_SESSION['idKorisnik'];
    echo '<div id="mojiPredmeti">';
    Saradnik::aktivanNa($saradnik);
}
else{
    echo "Morate se prijaviti da biste videli vaše predmete.";
}
echo '</section>';

    echo "</div>";
include_once 'templates/right.php';
include_once 'templates/footer.php';


?>