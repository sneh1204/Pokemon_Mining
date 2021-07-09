<?php
include_once '../config/constants.php';
include_once '../config/defaults.php';
//if(!isset($_SESSION['loggedin'])){   redirect(BASE . "/?notloggedin=true"); }
include_once "../database/Mysql.php";
include_once "../helpers/Functions.php";
if($_GET['p_search'] == ""){
    $_SESSION['error'] = "Invalid search request! Please enter something to search";
    redirect(CTRL . "Ctrl_error.php");
}
if(isset($_GET['p_search'])){
    $searchid = $_GET['p_search'];
    $searchid = str_replace(" ", "_", $searchid);
    if(!isset($_GET['pageid'])) $pageid = 1;
    else $pageid = $_GET['pageid'];
    $db = new Mysql();
    $values = $db->getSearchValuesByPage($searchid, $pageid);
    $totcount = $db->totalCountForSearch($searchid);
    include_once "../views/search.php";
}else{
    $_SESSION['error'] = "That page doesn't exist";
    redirect(CTRL . "Ctrl_error.php");
}
?>