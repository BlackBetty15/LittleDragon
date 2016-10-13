<?php


session_start();
include_once 'Saradnik.php';

$_SESSION['korisnikPromena']=$_GET['id'];
$page_title="Saradnik";//Predmet::nadjiIme();
include_once 'valicacija.php';
include_once 'templates/header.php';
include_once 'templates/left.php';
echo "<div class=\"col-6\">";

echo '<div id="saradnikStr">';

Saradnik::pisiSaradnika();
echo '</div><hr><br><h4>Predmeti na kojima je saradnik aktivan:</h4><br>';
$id=$_GET['id'];
echo'<div id="listica">';
Saradnik::aktivanNa($id);
echo '</div>';
if(isset($_SESSION['tip'])&&($_SESSION['tip']==1)){

                    //Dodavanje na predmet//
    echo'
            <form action="" method="post" id="dodajNa">

            <table>

                <tr>
                    <td><label for="imePr">Dodaj na predmet:</label></td>
                   <td> <select id="imePr">';
                    Predmet::listaDodavanje();

    echo'</select></td>
            <td><input type="button" id="dodajNaPredmet" value="+"></td>
                </tr>
                <tr>
                <td colspan="3">
                    <p id="porukaDodaj"></p>
                </td>
                </tr>
            </table>

            </form>
    ';

                //Uklanjanje sa predmeta//
    echo'
            <form action="" method="post" id="ukloniP">

            <table>

                <tr>
                    <td><label for="imePrUkl">Ukloni sa predmeta:</label></td>
                   <td> <select id="imePrUkl">';
        Predmet::listaUklanjanje($id);

    echo'</select></td>
            <td><input type="button" id="ukloni" value="-"></td>
                </tr>
                <tr>
                <td colspan="3">
                    <p id="porukaUkloni"></p>
                </td>
                </tr>
            </table>

            </form>
    ';

    echo '<input type="button" id="obrisiSaradnika" value="Obriši korisnika">';
    include_once 'templates/frmsaradnikdel.php';
    echo '<input type="button" id="deaktivirajS" value="Deaktiviraj korisnika">';
    include_once 'templates/frmdeaktiviraj.php';
}
echo '<hr>';



echo '<div id="izmene">';
if(isset($_SESSION['tip'])&&($_SESSION['tip']==1||$_SESSION['idKorisnik']==$_GET['id'])) {



    echo '<button id="frmtoggle">Izmeni profil</button>';

        include_once 'templates/frmizmene.php';
    echo '<br><br>';
        include_once 'templates/frmslika.php';
    echo '<p>Dozvoljeni formati su: jpg,png i gif</p>';
}

echo '</div>';

echo '</div>';

echo "</div>";
include_once 'templates/right.php';
include_once 'templates/footer.php';










?>