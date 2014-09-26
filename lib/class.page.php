<?PHP

 class Page {
	 
	 
	 function show($f3,$params){
		 
		 
		 
		 if(empty($params["goto"]))
		 {
			 if($f3->get('session'))
				 $f3->reroute('/page/home');
			 
			 else
				$f3->reroute('/page/login'); 
			 
		 }
		 
		 $page = ($params["goto"]!= "home") ? $params["goto"] : "aboutme";
		 
		 $f3->set('content', "templates/" . $page . ".html");
		 
		 $template=new Template;

		//echo $template->render('templates/template.html');
		 
	 }
	 
	 
	 function setLogin($f3){
		 
		global $db;
		 /*$f3->set('SESSION.test',"1234");
		echo $f3->get('SESSION.test');*/
		 
		 $f3->set("loign_error" , null);
		 
		if(!empty($f3->get('POST.username')) && !empty($f3->get('POST.pwd')))
		{
			$rows = $db->exec('SELECT * FROM users '.'WHERE username="'.$f3->get('POST.username').'"');
			
			if(!empty($rows))
			{
					
			}
			
			else
			 $f3->set("loign_error" , "Invalid username or password");
			
		}
		 
		$f3->set('content','templates/login.html');
		 
		$template=new Template;
		 
		echo $template->render('templates/template.html');
	 }
	 
	 
	 function setEncryptPassword($f3){
		 
		 $crypt = \Bcrypt::instance();
		 
		 $pwd  = "music123";
		 
		 echo $crypt->hash($pwd);
		 
		 
	 }
	
 } 
?>