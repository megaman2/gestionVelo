<?php

   class Reservation extends ROOT_Controller{

   	function __construct()   
	{        	        
		parent::__construct();   
	}	

	function  creer($prix,$moyenDePaiement ,$idClient,$idTour)         
	{
		$requete = 'INSERT INTO gv_Reservation VALUES (NULL,'.$prix.',\''.$moyenDePaiement.'\','.$idClient.','.$idTour.')';
		echo $requete;
		mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	
	}   

	function  supprimer($id){	  
		$requete = 'DELETE FROM `gv_Reservation` WHERE `gv_Reservation`.`id` = '.$id;                  
		mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
	}   

	function  lireTous(){  
		$requete = 'SELECT * FROM `gv_Reservation` WHERE 1';	  
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	  
		$rows = array();	  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$rows[] = $r;	          
		}	  
		print json_encode($rows);   
	}	

	function lire($id){	  
		$requete = 'SELECT * FROM `gv_Reservation` WHERE id='.$id;                  
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());                  
		$r = mysql_fetch_assoc($res);                  
		print json_encode($r);	
	}  	
}
?>
