<?php

	include("Root_Controller.php");
	include("Accessoire.php");
 
	if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
	{
	    $_REQUEST['fonction']($_REQUEST);
	}
	 
	function cree($data)
	{
		$a = new Accessoire();
		$res = $a->creer($_GET["nom"],$_GET["desc"]);
	}

	function lireTous()
	{
		$a = new Accessoire();
		print_r($a->lireTous());
	}

	function lire($data)
        {
		$a = new Accessoire();
        	print_r($a->lire($_GET["id"]));
        }


	function supprimer($data)
	{
		$a = new Accessoire();
		print_r($a->supprimer($_GET["id"]));
	}
	
	function modifier($data)
	{
		$a = new Accessoire();
		print_r($a->modifier($_GET["nom"],$_GET["desc"],$_GET["id"]));
	}

?>
