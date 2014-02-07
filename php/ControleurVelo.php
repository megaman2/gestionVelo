<?php

	include("Root_Controller.php");
	include("Velo.php");
 
	if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
	{
	    $_REQUEST['fonction']($_REQUEST);
	}
	 
	function creer($data)
	{
		$a = new Velo();
		$res = $a->creer($_GET["type"],$_GET["model"],$_GET["desc"],$_GET["date"]);
	}

	function lireTous()
	{
		$a = new Velo();
		print_r($a->lireTous());
	}

	function lire($data)
	{
		$a = new Velo();
		print_r($a->lire($_GET["id"]));
	}

	function supprimer($data)
	{
		$a = new Velo();
		print_r($a->supprimer($_GET["id"]));
	}
	
	function modifier($data)
	{
		$a = new Velo();
		print_r($a->modifier($_GET["type"],$_GET["model"],$_GET["desc"],$_GET["date"],$_GET["dateReparation"],$_GET["id"],$_GET["revisionD"],$_GET["revisionF"]));
	}

?>
