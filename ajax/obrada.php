<?php
require_once '../Predmet.php';
require_once '../Saradnik.php';

session_start();

$predmeti = Predmet::vratiSve();
$saradnici=Saradnik::sviSaradnici();

/*Dodavanje predmeta*/
if(isset($_GET['idZahtev']) && $_GET['idZahtev'] == 1)
{
    $opis=$_GET['opis'];
    $lab=intval($_GET['lab']);
    $nazivPredmeta = strtolower(trim($_GET['naziv']));
    $statusPredmeta = 0;
    $statusLab=0;

    foreach($predmeti as $predmet)
    {
        if(strtolower(trim($predmet['naziv'])) == $nazivPredmeta)
        {

            $statusPredmeta =1;
        }
        if($predmet['lab']==$lab){
            $statusLab=1;
        }
    }

    /*0-zauzeta lab. i predmet postoji,1-sve u redu, 2-predmet postoji, 3-lab zauzeta,4-problem nepoznat*/

    if($statusPredmeta==0&&$statusLab==0){

        $naziv=trim($_GET['naziv']);

        if ( Predmet::dodajPredmet($naziv,$opis,$lab)  ){
            $status=1;

        }
        else
            $status=4;
    }

    else if($statusPredmeta==1&&$statusLab==0) {

        $status=2;
    }

    else if($statusPredmeta==0&&$statusLab==1){
        $status=3;

    }

    else if($statusPredmeta==1&&$statusLab==1){
        $status=0;
    }

    else
    {
        $status=4;
    }

    echo $status;
    return;
}



/*Logovanje*/
if(isset($_POST['idZahtev'])&& ($_POST['idZahtev']==3)){

    //0 vraća za prazno, -1 za neispravno, 1 za sve ok;

    $korisnicko=$_POST['usr'];
    $lozinka=$_POST['pas'];
    $okidac=-1;

    foreach($saradnici as $s){

        if($s['username']==$korisnicko && $s['pass']==$lozinka){
            $okidac=1;
            break;
        }
    }

    echo $okidac;

    return;
}


//Dodavanje saradnika//

if(isset($_GET['idZahtev'])&&($_GET['idZahtev'])==2){

    $user=trim($_POST['user']);
    $pass=trim($_POST['pass']);
    $mail=trim($_POST['email']);
    $ime=trim($_POST['name']);
    $prezime=trim($_POST['Lname']);
    $bio=$_POST['biog'];
    $zvanje=trim($_POST['degree']);

    if(Saradnik::dodajSaradnika($user,$pass,$ime,$prezime,$mail,$bio,$zvanje)){
        $status=1;
    }
    else{
        $status=0;
    }

    echo $status;



}

if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==4)){


    $bio=trim($_POST['bio']);
    $id=$_SESSION['korisnikPromena'];

    if(Saradnik::dodajBiografiju($bio,$id)){
        echo 1;
    }
    else{
        echo 0;
    }

}
if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==5)){

    $pass=trim($_POST['pass']);
    $id=$_SESSION['korisnikPromena'];
    if($pass==""){
        echo -1;
    }
    else{
    if(Saradnik::promeniLozinku($pass,$id)){
        echo 1;
    }
    else{
        echo 0;
    }
    }
}

if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==6)){

    $opis=$_POST['opis'];
    $id=$_SESSION['predmetPromena'];

    if(Predmet::izmeniOpis($opis,$id)){
        echo 1;
    }
    else echo 0;


}
//Dodavanje na predmet//
if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==7)){

    $ime=$_POST['naziv'];
    $idP=Predmet::nadjiId($ime);
    $idS=$_SESSION['korisnikPromena'];


    $aktivan=Predmet::isActive($idS,$idP);

if($aktivan==3){

    if(Predmet::dodajNaPredmet($idS,$idP)){
        echo 1;
    }
}
    else if($aktivan==1){
        echo 0;
    }
    else if($aktivan==0){
            if(Predmet::aktiviraj($idS,$idP)){
                echo 2;
            }
        else
            echo 3;
    }



}
            //Uklanjanje predmeta//

if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==8)){

    $idS=$_SESSION['korisnikPromena'];
    $naziv=$_POST['predmet'];
    $idP=Predmet::nadjiId($naziv);

        if(Predmet::ukloni($idS,$idP)){
            echo 1;
        }
    else
        echo 0;
}
if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==9)){

    $idP=intval($_SESSION['predmetPromena']);

    if(Predmet::obrisiPredmet($idP)){

        echo 1;
    }
}
if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==10)){

    $idS=intval($_SESSION['korisnikPromena']);
    if(Saradnik::obrisiKorisnika($idS)){
        echo 1;
    }
}
if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==11)){
    $idS=intval($_SESSION['korisnikPromena']);
    if(Saradnik::deaktivirajKorisnika($idS)){
        echo 1;
    }
}
if(isset($_GET['idZahtev'])&&($_GET['idZahtev'])==12){

    $idS=intval($_POST['id']);

    if(Saradnik::aktiviraj($idS)){
        echo 1;
    }
    else
        echo 0;

}


//vežba//
if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==13)){

    $naziv=trim($_POST['ime']);
    $opis=trim($_POST['opisV']);
    $vreme=$_POST['time'];
    $datum=$_POST['date'];

    $noviD=date('Y/m/d',strtotime($datum));
    $novoV=date('H:i:s', strtotime($vreme));


    $id=intval($_SESSION['predmetPromena']);

    if(Predmet::dodajVezbu($id,$naziv,$opis,$vreme,$datum)){
        echo 1;
    }
    else{
        echo 0;
    }
}
//Brisanje vežbe//

if(isset($_GET['idZahtev'])&&($_GET['idZahtev'])==14){

    $idV=$_SESSION['idVezbaPromena'];

    if(Predmet::obrisiVezbu($idV)){
        echo 1;
    }
    else
        echo 0;

}
if(isset($_GET['idZahtev'])&&($_GET['idZahtev'])==15){

    $idS=intval($_POST['id']);
    $idV=$_SESSION['idVezbaPromena'];

    if(Saradnik::ukloniSaVezbe($idS,$idV)){
        echo 1;
    }
    else
        echo 0;



}
if(isset($_GET['idZahtev'])&&($_GET['idZahtev'])==16){

    $idV=intval($_SESSION['idVezbaPromena']);
    $idS=intval($_POST['id']);

    $aktivan=Saradnik::isActivV($idS,$idV);

    if($aktivan==3){

        if(Saradnik::dodajSrNaVezbu($idV,$idS)){
            echo 1;
        }
    }
    else if($aktivan==1){
        echo 0;
    }
    else if($aktivan==0){
        if(Saradnik::aktivirajV($idS,$idV)){
            echo 2;
        }
        else
            echo 3;
    }
}
if(isset($_GET['idZahtev'])&&($_GET['idZahtev'])==17){

    $idV=$_SESSION['idVezbaPromena'];
    $opis=trim($_POST['novi']);

    if(Predmet::promeniOpisV($idV,$opis)){
        echo 1;
    }
    else
        echo 0;


}
if(isset($_GET['idZahtev'])&&($_GET['idZahtev'])==18){

    $idV=$_SESSION['idVezbaPromena'];
    $naziv=trim($_POST['novi']);

    if(Predmet::promeniImeV($idV,$naziv)){
        echo 1;
    }
    else
        echo 0;

}

if(isset($_GET['idZahtev'])&&($_GET['idZahtev'])==19){

    $idV=$_SESSION['idVezbaPromena'];
    $datum=trim($_POST['novi']);
    $noviD=date('Y/m/d',strtotime($datum));

    if(Predmet::promeniDatumV($idV,$noviD)){
        echo 1;
    }
    else
        echo 0;

}


if(isset($_GET['idZahtev'])&&($_GET['idZahtev'])==20){

    $idV=$_SESSION['idVezbaPromena'];
    $vreme=trim($_POST['novi']);
    $novoV=date('H:i:s', strtotime($vreme));

    if(Predmet::promeniVremeV($idV,$novoV)){
        echo 1;
    }
    else
        echo 0;

}
if(isset($_GET['idZahtev'])&&($_GET['idZahtev'])==21){


    $idV=$_SESSION['idVezbaPromena'];

    if(Predmet::brisiMaterijal($idV)){
        echo 1;
    }
    else
        echo 0;
}

?>