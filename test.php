<?php

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

$naziv="Operativni sistemi1";
if(Predmet::nadjiId($naziv)){

    echo "uspelo!";
}
else{
    echo "Greška";
}