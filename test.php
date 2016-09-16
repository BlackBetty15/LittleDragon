<?php

require_once "Predmet.php";
require_once "Konekcija.php";
if( Predmet::dodajPredmet("Proba","",207) )
    echo "Uspelo";
else
    echo Konekcija::pokazivacKon()->getKonekcija()->error;