<?php
session_start();

require_once 'Saradnik.php';
require_once 'Konekcija.php';
require_once 'Predmet.php';


$idV=$_SESSION['idVezbaPromena'];
if(isset($_FILES['file'])&& !empty($_FILES['file'])){
    $privNaziv = $_FILES['file']['tmp_name'];
    $naziv = $_FILES['file']['name'];
    $tip=$_FILES['file']['type'];
    $strana='vezba.php?id='.$idV;

        $url='uploads/files/'.$naziv;

        move_uploaded_file($privNaziv, $url);
        if(Predmet::dodajMaterijal($idV,$url)){

            header('location:'.$strana);
            exit();
        }

}

else{
        header('location:'.$strana);
        return;
}