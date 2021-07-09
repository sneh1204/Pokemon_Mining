<?php
include_once '../config/constants.php';
include_once '../config/defaults.php';
//if(!isset($_SESSION['loggedin'])){   redirect(BASE . "/?notloggedin=true"); }
include_once "../helpers/Functions.php";
if(isset($_POST['pokeboturl'])){
	$dir = DIRE . '/plugins/pokebot/test.py';
	$command = "python3 $dir ".$_POST['pokeboturl'];
	$output = shell_exec($command);
	$_POST['output'] = substr($output, 0, -1);
	if(strtolower($_POST['output']) != "error" and strtolower($_POST['output']) != "pokemon not found"){
		$data = array("total" => 0);
		$name = DIRE . '/logs/counter.json';
		$jsonString = file_get_contents($name);
		if($jsonString != "")	$data = json_decode($jsonString, true);
		if(isset($_SESSION['last'])){
			if(strtolower($_SESSION['last']) != strtolower($_POST['output'])){
				$data['total']++;
				$fp = fopen($name, 'w');
				fwrite($fp, json_encode($data));
				fclose($fp);
			}
		}
		$_POST['visits'] = $data['total'];
	}
}
include_once "../views/pokebot.php";
?>