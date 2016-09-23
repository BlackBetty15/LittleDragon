<?php

require_once '../Saradnik.php';

$saradnici=Saradnik::sviSaradnici();


if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==1)){


    $korisnik=trim(strtolower($_POST['korisnicko']));
    $okidac=0;

    if($korisnik==""){
        $okidac=-1;
    }

    foreach($saradnici as $s){

        if(trim($s['username'])==$korisnik){
            $okidac=1;
        }
    }

    echo $okidac;

}


if(isset($_GET['idZahtev'])&&($_GET['idZahtev']==2)) {

    $mail = trim($_POST['email']);
    $okidac = 0;
    $okidacValid=0;

    if($mail==""){
        echo -1;
    }
    else{
    foreach ($saradnici as $s) {
        if (trim($s['mail']) == $mail) {
            $okidac = 1;
        }
    }



    if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        $okidacValid=1;
    }


    if($okidac==1&& $okidacValid==1){
        echo 0;
    }
   else if($okidac==1&& $okidacValid==0){

        echo 2;
    }
    else if($okidac==0 && $okidacValid==1){
        echo 3;
    }
    else if($okidac==0 && $okidacValid==0){
        echo 1;
    }

    }
}












?>