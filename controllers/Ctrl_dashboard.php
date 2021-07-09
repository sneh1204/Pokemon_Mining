<?php
include_once '../config/constants.php';
include_once '../config/defaults.php';
//if(!isset($_SESSION['loggedin'])){   redirect(BASE . "/?notloggedin=true"); }
include_once "../database/Mysql.php";
$_POST['enterPokemons'] = true;
include_once "../helpers/Functions.php";
include_once "../views/dashboard.php";
?>