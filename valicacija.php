<?php
/**
 * Created by PhpStorm.
 * User: milic
 * Date: 29.8.2016.
 * Time: 18.46
 */

if(!isset($_SESSION['tip'])){
    $status="Niste prijavljeni";        /*sve ove idu u slučaj 0, kad niko nije prijavljen*/
    $name="<button id=\"toggle\" onclick=\"prikazi()\">(prijavi se)</button>";



}

else if(($_SESSION['tip']!= null)&&($_SESSION['aktivan']==0)){
    $status="Niste prijavljeni";
    $name="<button id=\"toggle\" onclick=\"prikazi()\">(prijavi se)</button>";
    session_destroy();
    echo "<script> alert('Vaš profil je ugašen, obratite se adminu za ponovnu aktivaciju');
        window.location.reload();</script>";



}
else {
    $status = "<a href=\"stranasaradnik.php?id=".$_SESSION['id']."\">".$_SESSION['ime']." ".$_SESSION['prezime']."</a>";
    $name = "<a id=\"odjava\" href='logout.php'>(odjavi se)</a>";
}