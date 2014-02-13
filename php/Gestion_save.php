<?php   

	class Gestion extends ROOT_Controller{   

	function __construct()   
	{        	        
		parent::__construct();   
	}	

	function  getTour($parcours)         
	{
		$requete = "SELECT * FROM gv_Tour WHERE gv_Tour.parcours = '$parcours'" ;
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	  
		$rows = array();	  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$rows[] = $r;	          
		}	   
	}   

	function  getVelo($idTour){	
		$requete = "SELECT * FROM gv_Tour WHERE gv_Tour.id = '$idTour'" ;
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	  
		$tourInfo = array();	  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$tourInfo[] = $r;	          
		}
		/*$tourInfo contient les donnees du tour*/
		$requete = "SELECT id FROM `gv_Tour` WHERE NOT( gv_Tour.dateDepart > '".$tourInfo[0]['dateArrivee']."'  or 	gv_Tour.dateArrivee < '".$tourInfo[0]['dateDepart']."')";
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	  
		
		$tourAGerer = array();
		$whereTour="";  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$tourAGerer[] = $r;
			$whereTour=$whereTour.' gv_Materiel_Loue.gv_Tour_id= '.$r['id'].' or ' ;         
		}	
		$whereTour = substr($whereTour, 0, -4);
		/*$rows contient les id en colision avec le tour*/
		
		/*requete pour les velos et accessoire deja reserver ! */
		$requete = "SELECT gv_Velo_id, gv_Accessoire_id FROM  `gv_Velo`  INNER JOIN  `gv_Materiel_Loue` ON gv_Materiel_Loue.gv_velo_id = gv_Velo.id WHERE" . $whereTour;

	
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	
		$reserved = array();
		$notFreeVelo= 	array();  
		$notFreeAccessoire= 	array();  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$notFreeVelo[] = $r['gv_Velo_id'];
			$notFreeAccessoire[] = $r['gv_Accessoire_id'];
		}
		//print json_encode($notFreeVelo);   
		//print json_encode($notFreeAccessoire);  
		/*Selection des velos et accessoires fonctionnels ! faire attention au colission */


		$requete = "SELECT id FROM `gv_Velo` WHERE gv_Velo.debutReparation > '".$tourInfo[0]['dateArrivee']."' or gv_Velo.finReparation < '".$tourInfo[0]['dateDepart']."' or gv_Velo.debutReparation is null or gv_Velo.finReparation is null" ;

	
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	
		$freeVelo = array();	
		  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$freeVelo[] = $r['id'];
		}
		//print json_encode($freeVelo);


		$requete = "SELECT id FROM `gv_Accessoire` WHERE 1 ";

	
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	
		$freeAccessoire = array();	
		  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$freeAccessoire[] = $r['id'];
		}
		//print json_encode($freeAccessoire);

		
		/*on traite les infos*/
		
		$bonAccessoire = array_diff($freeAccessoire, $notFreeAccessoire);
		$bonVelo = array_diff($freeVelo, $notFreeVelo);
		
		//print_r($bonVelo);
		//print_r($bonAccessoire);

		$stringWhereVelo='';
		$stringWhereVelo2='';
		$stringWhereAccessoire='';

		foreach($bonVelo as $v){
			$stringWhereVelo = $stringWhereVelo.' id='.$v.' or ' ;
			$stringWhereVelo2= $stringWhereVelo2.'idVelo='.$v.' or ' ;
			
		}
		$stringWhereVelo = substr($stringWhereVelo, 0, -4);
		$stringWhereVelo2 = substr($stringWhereVelo2, 0, -4);
		
		foreach($bonAccessoire as $v){
			$stringWhereAccessoire = $stringWhereAccessoire.'  idAccessoire='.$v.' or ' ;
		}
		$stringWhereAccessoire = substr($stringWhereAccessoire, 0, -4);		
	
		$resFinal= array();
		
		$requete = "SELECT * FROM `gv_Velo` WHERE  ".$stringWhereVelo;
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());		  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$resFinal[] = $r;
		}

		$requete = "SELECT gv_Velo.id, gv_Velo.type, gv_Velo.model, gv_Velo.description, gv_Velo.dateAchat, gv_Velo.dateRevision, gv_Velo.debutReparation, gv_Velo.debutReparation, gv_Velo.finReparation, gv_Velo_Accessoire.idAccessoire,gv_Accessoire.nom,gv_Accessoire.description FROM  `gv_Velo` INNER JOIN  `gv_Velo_Accessoire`  ON  gv_Velo_Accessoire.idVelo = gv_Velo.id INNER JOIN  `gv_Accessoire`  ON gv_Velo_Accessoire.idAccessoire = gv_Accessoire.id WHERE ( ". 
		$stringWhereAccessoire . ') and ( '. $stringWhereVelo2. ')'; 
		;
		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());		  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$resFinal[] = $r;
		}

		print json_encode($resFinal);


	}   

	function  getReservation($idTour){  
		$requete = 'SELECT gv_Tour.dateDepart, gv_Tour.dateArrivee, gv_Tour.max, gv_Client.nom, gv_Client.prenom, gv_Velo.id, gv_Velo.type, gv_Velo.model, gv_Accessoire.id, gv_Accessoire.nom FROM gv_Materiel_Loue INNER JOIN gv_Tour ON (gv_Tour.id = gv_Materiel_Loue.gv_Tour_id) INNER JOIN gv_Reservation ON (gv_Tour.id = gv_Reservation.gv_Tour_id) INNER JOIN gv_Velo ON (gv_Velo.id = gv_Materiel_Loue.gv_Velo_id) INNER JOIN gv_Client ON (gv_Client.id = gv_Reservation.gv_Client_id) INNER JOIN	gv_Accessoire ON (gv_Accessoire.id = gv_Materiel_Loue.gv_Accessoire_id) WHERE gv_Tour.id =' .$idTour;	  



		$res =  mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());	  
		$rows = array();	  
		while($r = mysql_fetch_assoc($res)){    	  	   
			$rows[] = $r;	          
		}	  
		print json_encode($rows);   
	}	

	

	function  modifier($dateDepart,$dateArrivee ,$prix, $type, $parcours,$max, $id){

		$requete = 'UPDATE `gv_Tour` SET `dateDepart`=\''.$stringdateDepart.'\',`dateArrivee`=\''.$stringdateArrivee.'\',`prix`='.$prix.',`type`=\''.$type.'\',`parcours`=\''.$parcours.'\',`max`='.$max.' WHERE`gv_Tour`.`id` = '.$id;      
		echo $requete;            
		mysql_query($requete) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
	}   
}?> 
