<?php
require_once '../Predmet.php';
require_once '../Saradnik.php';

session_start();

$predmeti = Predmet::vratiSve();
$saradnici=Saradnik::sviSaradnici();

if(isset($_GET['idZahtev']) && $_GET['idZahtev'] == 1)
{
    $nazivPredmeta = trim($_GET['naziv']);
    $status = 0;


    foreach($predmeti as $predmet)
    {
        if(strtolower(trim($predmet['naziv'])) == $nazivPredmeta)
        {

            $status =1;
            break;

        }
    }
    echo $status;

    return;
}
if(isset($_GET['idZahtev']) && $_GET['idZahtev'] == 2){

    $lab=intval($_GET['labbr']);
    $status=0;

    foreach($predmeti as $p){

        if($p['lab']==$lab){

            $status=1;
            break;
        }
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


?>