<?php


session_start();
include_once 'Saradnik.php';
$page_title='Saradnici';


include_once 'valicacija.php';
include_once 'templates/header.php';
include_once 'templates/left.php';
echo "<div class=\"col-6\">";

echo "<h3>".$page_title."</h3><br><br>";

echo '<div id="listaS">';
Saradnik::listajSaradnike();
echo '</div>';

echo "<hr>";
if(isset($_SESSION['tip'])&&($_SESSION['tip']==1)){

        echo'<button id="frmtoggle">Dodaj novog saradnika</button>';
        include_once 'templates/frmsaradnik.php';
}
echo "</div>";
include_once 'templates/right.php';
include_once 'templates/footer.php';
?>