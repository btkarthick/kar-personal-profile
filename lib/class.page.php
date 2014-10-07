<?PHP

 class Page {
	 
	 
	 function show($f3,$params){
		 
		 if(!$f3->exists('SESSION.username'))
		 {	$f3->reroute('/login'); }
		
		 $page = trim($f3->get('PARAMS.goto'));
		
		 $page = (!empty($page)) ? $page : "aboutme";
		 
		 		 		 
		 $allowed_pages = $f3->split($f3->get("ALLOWED_PAGES"));
		 
		 		 
		 $notfound = in_array( $page , $allowed_pages  , true);
		 
		 $isLightBox = false;
		
		switch($page){
			 
			 case 'profile':
			 
			 	break;
			 
			 case 'portfolio':
			
					$docList = $this->setPortfolioDocs();
			
					$f3->set('doc_list' , $docList);
					
			  	break;
			 
			 case 'achievements':
			 
					$certificates = $this->setAchievements();
						
					$isLightBox = true;
					
					$f3->set('curriculam_college' , $certificates["culam_college"]);
					$f3->set('curriculam_hsc' , $certificates["culam_hsc"]);
					$f3->set('curriculam_ssc' , $certificates["culam_ssc"]);
			
					$f3->set('ecurriculam_college' , $certificates["eculam_college"]);
					$f3->set('ecurriculam_hsc' , $certificates["eculam_hsc"]);
					$f3->set('ecurriculam_ssc' , $certificates["eculam_ssc"]);
									
			 	break;
		 }
		 
		 if(!$notfound)
		 	$f3->error(404);
		 
		 else
			 
		 {
			  $f3->set('content', "templates/" . $page . ".html");
			  $f3->set('page' , $page);
		   	  $f3->set("isLightbox" , $isLightBox);
		   	  $f3->set("loggedIn" , true);
			  echo Template::instance()->render('templates/template.html');
		 }
		 
	 }
	 
	 
	 private function validatePassword($user)
	 {
		 global $f3;
		 
		 $crypt = \Bcrypt::instance();
		 
		 return $crypt->verify($f3->get('POST.pwd') , $user["password"]);
		 
	  }
	 
	 
	 public function setLogin($f3){
		 
		global $db;
		 
		 $login_error = null;
				 
		
		if($f3->exists('POST.username'))
		{
			$rows = $db->exec('SELECT * FROM users '.'WHERE username="'.$f3->get('POST.username').'"');
			
			if(!empty($rows))
			{
				if($this->validatePassword($rows[0]))
				{
					$f3->set("SESSION.username" , $rows[0]["username"]);
					
					$f3->set("SESSION.isAdmin" , $rows[0]["isAdmin"]);
					
					$f3->reroute('/page/aboutme');
				}
				
				else
					{$login_error = "Invalid password";}
				
			}
			
			else
			 {$login_error = "Invalid username";}
			
		}
		 
		 		 
		 $f3->set("loign_error" , $login_error);
		 $f3->set('content','templates/login.html');
		 $f3->set("loggedIn" , false);
		 $f3->set("isLightbox" , false);
		 $f3->set('page' , "login");
		 echo Template::instance()->render('templates/template.html');
	 }
	 
	 
	 public function setLogout($f3){
		 
		 $f3->clear('SESSION');
		 $f3->reroute('/login');
		 
	 }
	 
	 private function setPortfolioDocs(){
		 
		 global $f3;
		 
		 $fileList = $this->readFolder("portfolio");
		 
		$fileList = ($fileList) ? $fileList : false;
		 
		 return $fileList;
		
	 }
	 
	 
	 private function setAchievements(){
		 
		 global $f3;
		 
		 $culam_college = $this->readFolder("curricullam/college");
		 $all_certi["culam_college"] = ($culam_college) ?  $culam_college : false;
		 
		 $culam_hsc = $this->readFolder("curricullam/hsc");
		 $all_certi["culam_hsc"] = ($culam_hsc) ?  $culam_hsc : false;
		 
		 $culam_ssc = $this->readFolder("curricullam/ssc");
		 $all_certi["culam_ssc"] = ($culam_ssc) ?  $culam_ssc : false;
		 
		 
		  $eculam_college = $this->readFolder("extra-curriculum/college");
		 $all_certi["eculam_college"] = ($eculam_college) ?  $eculam_college : false;
		 
		 $eculam_hsc = $this->readFolder("extra-curriculum/hsc");
		 $all_certi["eculam_hsc"] = ($eculam_hsc) ?  $eculam_hsc : false;
		 
		 $eculam_ssc = $this->readFolder("extra-curriculum/ssc");
		 $all_certi["eculam_ssc"] = ($eculam_ssc) ?  $eculam_ssc : false;
				
		 return $all_certi;
	 }
	 
	 
/* Helper Functions Starts*/
	 
private function readFolder($folder_path){
	
	global $f3;
	
	$path = DOCROOT . $f3->get("doc_folder_name") . "/" . $folder_path . "/";	
	
	$out = array();
	
	$files = scandir($path);
	
	foreach($files as $key => $value)
	{
		if($value == "." || $value == "..")
		 continue;
		
		$out[] = array("original_name" => $value , 
					   
					   "filename" => setEncryptDecrption($value) , 
					   
					   "extension" => (new SplFileInfo($value))->getExtension()
					   
					  );
	}
	
	
	return $out; 
}
	 
	 
/*End of Helper Functions*/	 
	 
	 
	 public function setEncryptPassword($f3){
		 
		 $crypt = \Bcrypt::instance();
		 
		 $pwd  = "music123";
		 
		 echo $crypt->hash($pwd);
		 
		 
	 }
	
 }

?>