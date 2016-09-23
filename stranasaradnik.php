<?php


session_start();
include_once 'Saradnik.php';

$_SESSION['korisnikPromena']=$_GET['id'];
$page_title="Saradnik";//Predmet::nadjiIme();
include_once 'valicacija.php';
include_once 'templates/header.php';
include_once 'templates/left.php';
echo "<div class=\"col-6\">";


Saradnik::pisiSaradnika();




echo '<div id="izmene">';
if(isset($_SESSION['tip'])&&($_SESSION['tip']==1||$_SESSION['idKorisnik']==$_GET['id'])) {



    echo '<button id="frmtoggle">Izmeni profil</button>';

        include_once 'templates/frmizmene.php';

}

echo '</div>';



echo "</div>";
include_once 'templates/right.php';
include_once 'templates/footer.php';










?>