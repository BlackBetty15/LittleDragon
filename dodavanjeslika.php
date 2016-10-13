
<?php

session_start();

require_once 'Saradnik.php';
require_once 'Konekcija.php';
require_once 'Predmet.php';
$dozvoljeniFormati=[
    'image/jpeg','image/png','image/gif'
];

$idS=$_SESSION['korisnikPromena'];
if(isset($_FILES['file'])&& !empty($_FILES['file'])){
$privNaziv = $_FILES['file']['tmp_name'];
$naziv = $_FILES['file']['name'];
$tip=$_FILES['file']['type'];
    $strana='stranasaradnik.php?id='.$idS;

foreach($dozvoljeniFormati as $df){
    if($df==$tip){
        $status=1;
        break;
    }
    else
        $status=0;
}

if($status == 0)
{
    header('location:'.$strana);
return;}

else{
    $url='uploads/images/'.$naziv;

    move_uploaded_file($privNaziv, $url);
    if(Saradnik::dodajSliku($idS,$url)){

        header('location:'.$strana);
        exit();
        }
    }
}


