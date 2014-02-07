<?php

include("Root_Controller.php");
include("Accessoire.php");
include("Velo.php");
include("Velo_Accessoire.php");

/*$v = new Velo();
$a = new Accessoire();


//print_r($v->creer("type","model","desc","2014-02-10 "));
print_r($v->lireTous());

//print_r($a->lireTous());

*/

$a = new Velo_Accessoire();	
print_r($a->supprimer(2,2));
print_r($a->supprimer(2,3));

print_r($a->supprimer(2,4));
print_r($a->supprimer(5,2));

//print_r($a->supprimer(2,2));
?>
