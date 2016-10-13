<?php
session_start();
require_once "Predmet.php";
require_once "Konekcija.php";
/*if( Predmet::dodajPredmet("Proba","",207) )
    echo "Uspelo";
else
    echo Konekcija::pokazivacKon()->getKonekcija()->error;*/
/*
if(Saradnik::dodajSaradnika("petar",'petar123','petar','petrovic','petar@viser.edu.rs','','spec.')){
    echo "Uspelo!";
}
else
    echo Konekcija::pokazivacKon()->getKonekcija()->error;*/

/*
$vremeForma =intval( "12:12");
$datumFrma = "1.1.12.";
$vreme=strtotime('H:i:s',$vremeForma);
echo $vreme.'<br>';
$datum=strtotime('j,n,Y',$datumFrma);
echo $datum;*/
