<?php

require_once "../Predmet.php"; //ako premestas, uradi vracanje
require_once "../Konekcija.php";

/**
 * Created by PhpStorm.
 * User: milic
 * Date: 4.9.2016.
 * Time: 22.35
 */

if( isset($_GET['idZahtev']) && $_GET['idZahtev'] == 1)
{
    if(!empty($_GET['naziv'])&&!empty($_GET['lab'])){
    $naziv = $_GET['naziv'];
    $lab = intval($_GET['lab']);
    $opis=$_GET['opis'];
    

        if($naziv==""||$lab==""){

            $status=0;
            echo $status;
        }
        else{
            if ( Predmet::dodajPredmet($naziv,$opis,$lab)  ){
                $status=1;
                echo $status;
            }
            $status=2;
            echo $status;
        }
    }

   /* if ( Predmet::dodajPredmet($naziv,$opis,$lab)  )
        echo "Predmet uspesno dodat.";
    else
        echo "Doslo je do greske pri ubacivanju u bazu.";
    }
    else if(empty($_GET['naziv'])||empty($_GET['lab']))
        echo "Morate popuniti sva polja označena *.";
    else
        echo "Došlo je do neke greške";*/
    return;
}