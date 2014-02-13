<?php

	include("Root_Controller.php");
	include("Tour.php");
 
	if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
	{
	    $_REQUEST['fonction']($_REQUEST);
	}
	 
	function creer($data)
	{
		$a = new Tour();
		$res = $a->creer($_GET["dateDepart"],$_GET["dateArrivee"],$_GET["prix"],$_GET["type"],$_GET["parcours"],$_GET["max"]);
	}

	function lireTous()
	{
		$a = new Tour();
		print_r($a->lireTous());
	}

	function lire($data)
        {
		$a = new Tour();
        	print_r($a->lire($_GET["id"]));
        }


	function supprimer($data)
	{
		$a = new Tour();
		print_r($a->supprimer($_GET["id"]));
	}
	
	function modifier($data)
	{
		$a = new Tour();
		print_r($a->modifier($_GET["dateDepart"],$_GET["dateArrivee"],$_GET["prix"],$_GET["type"],$_GET["parcours"],$_GET["max"],$_GET["id"]));
	}

?>
