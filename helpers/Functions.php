<?php

include_once "../config/constants.php";
include_once "../config/defaults.php";
include_once "../database/Mysql.php";
include_once "../manager/Entitymanager.php";

$db = new Mysql();
/*
if(isset($_GET['logout'])){
    session_destroy();
    redirect(BASE);
} 
*/

if(isset($_POST['search']))    echo json_encode($db->getSearchValues($_POST['search']));

if(isset($_POST['getPokemonCount']))    echo count($_SESSION["pokemons"]);

if(isset($_POST['getHighestHP']))   echo json_encode($db->getHighestHP());

if(isset($_POST['getHighestAttack']))   echo json_encode($db->getHighestAttack());

if(isset($_POST['getHighestDefense'])) echo json_encode($db->getHighestDefense());

if(isset($_POST['enterPokemons'])){
    if(!isset($_SESSION["entered"])){
        $em = new Entitymanager();
        $em->enterPokemons();
        $_SESSION['entered'] = true;
    }
}
?>