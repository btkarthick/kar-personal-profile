<?PHP

	require_once('lib/class.page.php');

	$f3 = require('lib/base.php');

	//$f3->set('CACHE',FALSE);
		
	// Set the config file here

	$f3->config('config.ini');

	$dbvalues = $f3->get('dbDriver') . ":host=" . $f3->get('dbHost') . ";";
	$dbvalues.= "port=" . $f3->get('dbPort') . ";dbname=" . $f3->get('dbSelected');

	$db=new \DB\SQL($dbvalues, $f3->get("dbUser") , $f3->get("dbPass"));
	

	/*$f3->set('ONERROR',function($f3){
		
  		echo $f3->get('ERROR.status');
	
	});*/

	$f3->run();

?>