<?php


session_start();
include_once 'Predmet.php';

$page_title="Predmeti";
include_once 'valicacija.php';
include_once 'templates/header.php';
include_once 'templates/left.php';
echo "<div class=\"col-6\">";

echo "<h3>".$page_title."</h3><br><br>";
echo '<div id="listaP">';
Predmet::listajPredmet();
echo '</div>';

echo "<hr>";

if(isset($_SESSION['tip'])&&($_SESSION['tip']==1)){
    echo'<button id="frmtoggle">Dodaj novi predmet</button>';
    include_once 'templates/frmpredmet.php';

}
/*Toggle za dodavanje predmeta*/
echo "</div>";
include_once 'templates/right.php';
include_once 'templates/footer.php';




?>