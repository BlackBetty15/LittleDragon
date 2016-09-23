<?php



session_start();
include_once 'Predmet.php';
include_once 'Saradnik.php';
$_SESSION['predmetPromena']=$_GET['id'];
$page_title=Predmet::nadjiIme();
include_once 'valicacija.php';
include_once 'templates/header.php';
include_once 'templates/left.php';
echo "<div class=\"col-6\">";

echo '<div id="stranaP">';
Predmet::pisiPredmet();
echo '</div><hr>';

$idP=$_GET['id'];


if(isset($_SESSION['tip'])){
    $idS=$_SESSION['idKorisnik'];
    $korisnikov=Saradnik::mojPredmet($idP,$idS);
    if(($_SESSION['tip']==1)||$korisnikov==1){
        echo '<input type="button" value="Izmena opisa" id="frmtoggle">';
        include_once 'templates/frmopis.php';
        echo '<hr>';
    }
}
echo '<h3>Vežbe:</h3><br>';



echo "</div>";
include_once 'templates/right.php';
include_once 'templates/footer.php';
?>