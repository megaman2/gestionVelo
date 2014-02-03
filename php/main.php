<?php

include("Root_Controller.php");
include("Accessoire.php");


$a = new Accessoire();

//$res = $a->creer('eee','desc');

print_r($a->modifier("nom","desc",1));
	
?>
