<?php

   class Velo extends ROOT_Controller{

   	function __construct()   
	{        	        
		parent::__construct();   
	}	

	function  creer($type,$model ,$description, $date)         
	{
		$dateRevison = new DateTime($date, new DateTimeZone('Europe/Paris'));	
		$dateRevison->modify("+ 3 month");
		$date = new DateTime($date, new DateTimeZone('Europe/Paris'));	
		$requete = 'INSERT INTO gv_Velo VALUES (NULL,"'.$type.'","'.$model.'","'.$description.'","'.$date->format('Y-m-d').'", "'.$dateRevison->format('Y-m-d').'",NULL,NULL)';	
		mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	
		print_r($date);
	}   

	function  supprimer($id){	  
		$requete = 'DELETE FROM `gv_Velo` WHERE `gv_Velo`.`id` = '.$id;                  
		mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
	}   

	function  lireTous(){  
		$requete = 'SELECT * FROM `gv_Velo` WHERE 1';	  
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	  
		$rows = array();	  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$rows[] = $r;	          
		}	  
		print json_encode($rows);   
	}	

	function lire($id){	  
		$requete = 'SELECT * FROM `gv_Velo` WHERE id='.$id;                  
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());                  
		$r = mysql_fetch_assoc($res);                  
		print json_encode($r);	
	}  	

	function  modifier($type,$model ,$description, $date, $dateRevision,$id,$reparationDebut,$reparationFin){
		  $reparationDebut = new DateTime($reparationDebut, new DateTimeZone('Europe/Paris'));
		  $reparationDebutstring = $reparationDebut->format('Y-m-d H:i:s');
		  $reparationFin = new DateTime($reparationFin, new DateTimeZone('Europe/Paris'));
		  $reparationFinstring = $reparationDebut->format('Y-m-d H:i:s');
		  $date = new DateTime($date, new DateTimeZone('Europe/Paris'));
		  $datestring = $reparationDebut->format('Y-m-d H:i:s');
		  $dateRevision = new DateTime($dateRevision, new DateTimeZone('Europe/Paris'));
		  $dateRevisionstring = $reparationDebut->format('Y-m-d H:i:s');
			
		  //$requete = "UPDATE `gv_Velo` SET `type`= '$type' ,`description`= '$description' ,`model`= '$model' WHERE `id`=$id";
		 $requete = "UPDATE `gv_Velo` SET `type`= '$type' ,`description`= '$description' ,`model`= '$model' ,`dateAchat`= '$datestring' ,`dateRevision`= '$dateRevisionstring'  ,`debutReparation`= '$reparationDebutstring' ,`finReparation`= '$reparationFinstring' WHERE `id`=$id";       
		mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	}   
   }
?>
