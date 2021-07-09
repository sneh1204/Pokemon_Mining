<?php

include_once "../config/constants.php";
include_once "../config/defaults.php";
include_once "../database/Mysql.php";

class Entitymanager{
    public function enterPokemons(){
        $db = new Mysql();
        $pokemons = $db->getAllPokemons();
        $_SESSION['pokemons'] = $pokemons;
        return true;
    }
}
?>