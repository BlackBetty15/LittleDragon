<?php
/**
 * Created by PhpStorm.
 * User: milica
 * Date: 11.8.2016.
 * Time: 13.50
 */
session_start();
require_once 'Predmet.php';
require_once 'Saradnik.php';
$idV=$_GET['id'];
$_SESSION['idVezbaPromena']=$idV;
$ime=Predmet::vratiImeV($idV);
$idP=Predmet::nadjiIdPredmeta($idV);
if(isset($_SESSION['tip'])){
    $idS=$_SESSION['idKorisnik'];
    $moj=Saradnik::mojPredmet($idP,$idS);}
$page_title=$ime['naziv'];
require_once 'Saradnik.php';
include_once 'valicacija.php';
include_once 'templates/header.php';
include_once 'templates/left.php';
echo "<div class=\"col-6\">";

echo "<h3 id='vezbica'>".$page_title."</h3>";
echo "<br>";

Predmet::ispisiVezbu($idV);

echo'<br>';



if(isset($_SESSION['tip'])&&(($_SESSION['tip']==1)||$moj==1)){

    //Dodavanje na predmet//
    echo'
            <form action="" method="post" id="dodajNaV">

            <table>

                <tr>
                    <td><label for="imeSr">Dodaj na vežbu:</label></td>
                   <td> <select id="imeSr">';
    Saradnik::mojiSaradnici($idP);

    echo'</select></td>
            <td><input type="button" id="dodajNaVezbu" value="+"></td>
                </tr>
                <tr>
                <td colspan="3">
                    <p id="porukaDodajV"></p>
                </td>
                </tr>
            </table>

            </form>
    ';

    echo '<div id="osvezi"><form method="post" action="#" id="ukloniSV">
        <table>
             <tr>
                <td><label for="ukloniSar">Ukloni sa vežbe</label></td>
                <td><select id="ukloniSar">';
        Saradnik::listaUklanjanjeS($idV);
    echo '</select></td>
            <td><input type="button" id="ukloniSaV" value="-"></td>
            </tr>

            <tr>
                <td colspan="3">
                    <p id="porukaUkloniV"></p>
                </td>
            </tr>


        </table></form></div>';





echo '<input type="button" id="obrisiVezbu" value="Obriši vežbu">';
    include_once 'templates/frmbrisivezbu.php';
echo '<br><hr>';
//Izmena vežbe//
echo '<input type="button" id="izmeniMe" value="Izmeni vežbu">';
    include_once 'templates/frmizmenivezbu.php';
echo '<br> <br>';

//Dodavanje materijala//
    include_once 'templates/frmdodajmaterijal.php';
    echo'<p>Dozvoljeni formati su .xls,.xlsx,.pdf,.zip,.doc,.docx,.ppt,.pptx </p>';
    //Uklanjanje materijala//
    echo '<input type="button" id="uklonimat" value="Ukloni sav materijal">';
    include_once 'templates/frmuklonim.php';
}
echo '<hr><br>';

echo '<h4>Na ovoj vežbi su angažovani:</h4>';
echo '<div id="saradniciVezbe">';


Saradnik::mojiPredavaci($idV);
echo'</div>';

echo '<br><br><div id="materijal">';
echo'<h3>Materijali za vežbu</h3>';
Predmet::ispisMaterijala($idV);

echo'</div>';




echo "</div>";
include_once 'templates/right.php';
include_once 'templates/footer.php';