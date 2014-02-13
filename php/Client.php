<?php   
	class Client extends ROOT_Controller{   

	function __construct()   
	{        	        
		parent::__construct();   
	}	

	function  creer($nom,$prenom,$email,$numero ,$prixTotal)         
	{
		$requete = 'INSERT INTO gv_Client VALUES (NULL,"'.$nom.'","'.$prenom.'","'.$email.'","'.$numero.'","'.$prixTotal.'")';	
		mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	
	}   

	function  supprimer($id){	  
		$requete = 'DELETE FROM `gv_Client` WHERE `gv_Tour`.`id` = '.$id;                  
		mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
	}   

	function  lireTous(){  
		$requete = 'SELECT * FROM `gv_Client` WHERE 1';	  
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	  
		$rows = array();	  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$rows[] = $r;	          
		}	  
		print json_encode($rows);   
	}	

	function lire($id){	  
		$requete = 'SELECT * FROM `gv_Client` WHERE id='.$id;                  
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());                  
		$r = mysql_fetch_assoc($res);                  
		print json_encode($r);	
	}  	

	function  modifier($dateDepart,$dateArrivee ,$prix, $type, $parcours,$max, $id){

		$requete = 'UPDATE `gv_Tour` SET `dateDepart`=\''.$stringdateDepart.'\',`dateArrivee`=\''.$stringdateArrivee.'\',`prix`='.$prix.',`type`=\''.$type.'\',`parcours`=\''.$parcours.'\',`max`='.$max.' WHERE`gv_Tour`.`id` = '.$id;      
		echo $requete;            
		mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
	}   
}?> 
