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
		 
		 new Session();

		$f3->set('SESSION.test',false);
		echo $f3->get('SESSION.test');
		 
	 }
	 	 
 } 


?>