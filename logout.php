<?php
/**
 * Created by PhpStorm.
 * User: milica
 * Date: 28.8.2016.
 * Time: 20.47
 */
session_start();

session_unset();

session_destroy();

header('Location:index.php');
exit();
?>