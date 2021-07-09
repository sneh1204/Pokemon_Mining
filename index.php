<?php

include_once 'config/constants.php';
include_once 'config/defaults.php';
include_once "database/Mysql.php";

// redirect
/*
if(!isset($_SESSION['loggedin']))    include_once "views/login.php";
else    redirect(CTRL . "Ctrl_dashboard.php");
*/
redirect(CTRL . "Pokebot.php");
?>