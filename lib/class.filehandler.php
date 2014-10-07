<?PHP

class Filehandler {

	public function photo_handler($f3){
	
		/*echo $f3->get('PARAMS.certi_type') . "<br>";
		
		echo $f3->get('PARAMS.category') . "<br>";
		
		echo $f3->get('PARAMS.filename') . "<br>";*/
		
		$temp = $f3->get('certi_folder');
		
		//echo $temp[$f3->get('PARAMS.certi_type')];
		
		
		
		$docpath = DOCROOT . "/";
		$docpath .= $f3->get("doc_folder_name") . "/";
		$docpath .= $temp[$f3->get('PARAMS.certi_type')] . "/";
		$docpath .= $f3->get('PARAMS.category') . "/";
		
					
		$file = $f3->get('PARAMS.filename');
		
		$file =  setEncryptDecrption($file , false);
		
		
		$img = new Image($file , FALSE , $docpath);
		
		$img->render();
		
			
		exit();
		
	}
	
	
	public function download($f3,$args){
		
		$filename = $args['filename'];
		
		$filename =  setEncryptDecrption($filename , false);
				
		$file = DOCROOT . $f3->get("doc_folder_name") . "/" . "portfolio/" . basename($filename);
		
				
		/*if (file_exists($file))
		{
		
			header('Content-Description: File Transfer');
			header('Content-Type: application/pdf');
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
			header("Content-Type: application/force-download");
			header("Content-Type: application/download");
			header("Content-Disposition: attachment; filename={$filename}");
			header("Content-Transfer-Encoding: binary ");
			header('Content-Length: ' . filesize($file));
			while(ob_get_level()) ob_end_clean();
			flush();
			readfile($file);
			die;
			
		}*/
			
		
		
		
		 // send() method returns FALSE if file doesn't exist
        if (!Web::instance()->send($file))
		{
			// Generate an HTTP 404
        	$f3->error(404);
			
		}    

		exit();
	}


}