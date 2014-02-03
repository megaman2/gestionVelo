<?php

	include("Root_Controller.php");
	include("Velo.php");
 
	if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
	{
	    $_REQUEST['fonction']($_REQUEST);
	}
	 
	function cree($data)
	{
		$a = new Velo();
		$res = $a->creer($_GET["nom"],$_GET["desc"]);
	}

	function lire()
	{
		$a = new Velo();
		print_r($a->lire());
	}

	function supprimer($data)
	{
		$a = new Velo();
		print_r($a->supprimer($_GET["id"]));
	}
	
	function modifier($data)
	{
		$a = new Velo();
		print_r($a->modifier($_GET["nom"],$_GET["desc"],$_GET["id"]));
	}

?>
