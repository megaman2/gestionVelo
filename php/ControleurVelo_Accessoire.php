<?php

	include("Root_Controller.php");
	include("Velo_Accessoire.php");
 
	if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
	{
	    $_REQUEST['fonction']($_REQUEST);
	}
	 
	function ajouter($data)
	{
		$a = new Velo_Accessoire();	
		print_r($a->ajouter($_GET["idVelo"],$_GET["idAccessoire"]));
	}

	function supprimer($data)
	{
		$a = new Velo_Accessoire();	
		print_r($a->supprimer($_GET["idVelo"],$_GET["idAccessoire"]));
	}

	function estValidee($data)
	{
		$a = new Velo_Accessoire();	
		print_r($a->estValidee($_GET["idVelo"],$_GET["idAccessoire"]));
	}

?>
