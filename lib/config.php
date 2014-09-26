<?PHP
/*
 
 * Configuration File
 * To Initailze Database, session etc...
 * Other useful functions
 
 */
 
/*Set the default cache to false*/
//$f3->set('CACHE',FALSE);


/*Call the config file here*/

$f3->config('config.ini');


/*Database settings and initialzing*/

$dbvalues = $f3->get('dbDriver') . ":host=" . $f3->get('dbHost') . ";";
$dbvalues.= "port=" . $f3->get('dbPort') . ";dbname=" . $f3->get('dbSelected');

$db=new \DB\SQL($dbvalues, $f3->get("dbUser") , $f3->get("dbPass"));

/*End of database settings*/

/*Initializing Session*/

 new Session();
	
/*End of Session initialization*/	

/*Redirect error to 404 page*/

/*$f3->set('ONERROR',function($f3){
		
  		echo $f3->get('ERROR.status');
	
	});*/



/*Useful functions here*/

function print_object($object)
{
	echo "<pre>";
	
	print_r($object);
	
	echo "</pre>";
}


?>