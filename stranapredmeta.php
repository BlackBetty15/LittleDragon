<?php



session_start();
include_once 'Predmet.php';
include_once 'Saradnik.php';
$_SESSION['predmetPromena']=$_GET['id'];
$idP=$_GET['id'];
$page_title=Predmet::nadjiIme();
include_once 'valicacija.php';
include_once 'templates/header.php';
include_once 'templates/left.php';
echo "<div class=\"col-6\">";

echo '<div id="stranaP">';
Predmet::pisiPredmet();
echo '</div><hr>';
echo '<div id="saradniciNaPr">';
echo '<h3 style="font-size:20px;font-weight: bold;">Saradnici angažovani na predmetu su:</h3><br>';
echo        '<ul>
    '.Predmet::mojiSaradnici($idP).'
            </ul>';
echo '</div><hr>';

$idP=$_GET['id'];


if(isset($_SESSION['tip'])){
    $idS=$_SESSION['idKorisnik'];
    $korisnikov=Saradnik::mojPredmet($idP,$idS);
    if(($_SESSION['tip']==1)||$korisnikov==1){
        echo '<input type="button" value="Izmena opisa" id="frmtoggle">';
        include_once 'templates/frmopis.php';
        echo '<br><hr>';
    }
    if($_SESSION['tip']==1){

        echo '<input type="button" value="Obriši predmet" id="deletetoggle">';
        include_once 'templates/frmbrisanje.php';
    }
}
echo '<h3>Vežbe:</h3><br>';
if(isset($_SESSION['tip'])){
    $mp=Saradnik::mojPredmet($idP,$idS);
    if($_SESSION['tip']==1||($mp==1)){

    include_once 'templates/frmvezba.php';
        echo'<br><br><br>';
    }
}

echo '<div id="listaV">
        <ul id="listaVezbi">';
Predmet::pisiVezbuZaPredmet($idP);
        echo'</ul></div>';


echo "</div>";
include_once 'templates/right.php';
include_once 'templates/footer.php';
?>