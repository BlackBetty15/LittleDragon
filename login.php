<?php

require_once 'Konekcija.php';

session_start();

if (!empty($_POST['usr'])&& !empty($_POST['psd'])){

    $usr=$_POST['usr'];
    $psd=$_POST['psd'];

    $vrednost=Konekcija::login($usr,$psd);

    if (is_array($vrednost)){

        $_SESSION['id']=$vrednost['id'];
        $_SESSION['tip']=$vrednost['tip'];
        $_SESSION['korisnik']=$vrednost['username'];
        $_SESSION['lozinka']=$vrednost['pass'];
        $_SESSION['aktivan']=$vrednost['aktivan'];
        $_SESSION['ime']=$vrednost['ime'];
        $_SESSION['prezime']=$vrednost['prezime'];

        Konekcija::redirectUser($page='index.php');
        exit();

    }

    else{

            Konekcija::redirectUser($page='index.php');
            exit();
        }



}






?>