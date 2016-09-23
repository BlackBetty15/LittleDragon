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

?>