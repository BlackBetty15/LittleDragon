<?php
session_start();

$idS=$_SESSION['korisnikPromena'];

$privNaziv = $_FILES['file']['tmp_name'];
$naziv = $_FILES['file']['name'];


//slika
if(isset($_GET['idZahtev']) && $_GET['idZahtev']==1)
{
    move_uploaded_file($privNaziv, '../uploads/images/' . $naziv);
    echo "Uspesno ste promenili sliku!";
}

//fajlovi
if(isset($_GET['idZahtev']) && $_GET['idZahtev']==2)
{
    move_uploaded_file($privNaziv, '../uploads/files/' . $naziv);
}
?>