<?PHP
/*
 
 * Configuration File
 * To Initailze Database, session etc...
 * Other useful functions
 
 */
 
/*
*
* Set the default cache
* If this is not set to true, session won't work
*/
$f3->set('CACHE', TRUE);


/*Call the config file here*/

$f3->config(DOCROOT . 'profile_library/config.ini');


/*Database settings and initialzing*/

$dbvalues = $f3->get('dbDriver') . ":host=" . $f3->get('dbHost') . ";";
$dbvalues.= "port=" . $f3->get('dbPort') . ";dbname=" . $f3->get('dbSelected');

$db=new \DB\SQL($dbvalues, $f3->get("dbUser") , $f3->get("dbPass"));


/*End of database settings*/

/*Initializing Session*/

 new Session();
	
/*End of Session initialization*/


// Instantiate Log here

require_once(DOCROOT . 'profile_library/class.page.php');


require_once(DOCROOT . 'profile_library/class.filehandler.php');


/*Redirect error to 404 page*/

$f3->set('ONERROR',function($f3){
		
  		echo $f3->get('ERROR.code') . "<br>";
	
		echo $f3->get('ERROR.status') . "<br>";
	
		echo $f3->get('ERROR.text') . "<br>";
		
		//echo $f3->get('ERROR.trace');
	
	
	});



/*Useful functions here*/


/*
 *	Simple function to encrypt and decrypt
 *  Will be used in file names
 *  @PARAMS , $str - string to be encrypted or decrypted
 *  @PARAMS , $action - TRUE means encrypt , FALSE means decrypt. default TRUE
 */

 function setEncryptDecrption($str , $action = TRUE)
 {
	 global $f3;
	 
	 $output = false;
	 
	 $encrypt_method = "AES-256-CBC";
	 
	 	 
	 // SET HASH HERE
	 
	 $key = hash('sha256', $f3->get('hash_salt'));
	 
	 // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	 
	 $iv = substr(hash('sha256', $f3->get('secret_iv')), 0, 16);
	 
	 if($action)
	 {
		 $output = openssl_encrypt($str, $encrypt_method, $key, 0, $iv);
         $output = base64_encode($output);
	 }
	 
	 else
	 {
		 $output = openssl_decrypt(base64_decode($str), $encrypt_method, $key, 0, $iv);
	 }
	 
	 return $output;
 }



function print_object($object)
{
	echo "<pre>";
	
	print_r($object);
	
	echo "</pre>";
}


?>