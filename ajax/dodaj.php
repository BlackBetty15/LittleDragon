<?php

require_once '../Saradnik.php';
require_once '../Predmet.php';

session_start();


if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==1)){


    $nedelja=intval($_POST['dan']);


    if($nedelja==1){

        $min="2016/09/01";
        $max="2016/09/08";
    }
    else if($nedelja==2){
        $min="2016/09/09";
        $max="2016/09/16";

    }
    else{
        $min="2016/09/17";
        $max="2016/09/30";
    }

    $novimin=date('Y/m/d',strtotime($min));
    $novimax=date('Y/m/d',strtotime($max));

    $vezbe=Predmet::vratiZaVežbu($novimin,$novimax);

    echo $vezbe;



}


?>