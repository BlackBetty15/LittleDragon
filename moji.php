<?php


session_start();




$page_title="Moji predmeti";
include_once 'valicacija.php';
include_once 'templates/header.php';
include_once 'templates/left.php';
echo "<div class=\"col-6\">";

    echo "<h3>".$page_title."</h3>";

                /*kod*/

    echo "</div>";
include_once 'templates/right.php';
include_once 'templates/footer.php';


?>