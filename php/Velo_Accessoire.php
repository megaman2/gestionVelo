<?php

   class Velo_Accessoire extends ROOT_Controller{   

	function __construct()   
	{        	        
		parent::__construct();   
	}	

	function  ajouter($idVelo,$idAccessoire)         
	{
		$requete = 'SELECT COUNT(*) FROM gv_Velo_Accessoire WHERE (idVelo='.$idVelo.' and  idAccessoire='.$idAccessoire.')';	
		$res = mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$r = mysql_fetch_assoc($res);	
		if($r['COUNT(*)'] == 0 ){
			$requete = 'INSERT INTO gv_Velo_Accessoire VALUES ("'.$idVelo.'","'.$idAccessoire.'")';	
			mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		}
	}   

	function  supprimer($idVelo,$idAccessoire)         
	{
		$requete = 'SELECT COUNT(*) FROM gv_Velo_Accessoire WHERE (idVelo='.$idVelo.' and  idAccessoire='.$idAccessoire.')';	
		$res = mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$r = mysql_fetch_assoc($res);	
		if($r['COUNT(*)'] != 0 ){
			$requete = 'DELETE FROM `gv_Velo_Accessoire` WHERE (idVelo='.$idVelo.' and  idAccessoire='.$idAccessoire.')';
			mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		}
	} 

	function  estValidee($idVelo,$idAccessoire)         
	{
		$requete = 'SELECT COUNT(*) FROM gv_Velo_Accessoire WHERE (idVelo='.$idVelo.' and  idAccessoire='.$idAccessoire.')';	
		$res = mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$r = mysql_fetch_assoc($res);
		return json_encode($r);
	} 
   }
?>
