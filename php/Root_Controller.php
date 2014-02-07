<?php 
     
    class Root_Controller 
    {
        protected   $db;
		  
        public function __construct()
        {            
		ini_set('display_errors', 1);
           $this->db = mysql_connect('localhost', 'root', 'p3x3578');
	   	       mysql_select_db('gestion_velo');
        }
 
        protected function checkNull($datVar)
        {
            if ( empty($datVar) || $datVar == null){
               return null;
	    }
            return $datVar;
        }
		
    }
 
?>
