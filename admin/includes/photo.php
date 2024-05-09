<?php 


class Photo extends Db_object {

			protected static $db_table = "photos";
			protected static $db_table_fields = array('id', 'title','caption', 'description', 'filename','alternate_text', 'type', 'size');
			public $id;
			public $title;
			public $caption;
			public $description;
			public $filename;
			public $alternate_text;
			public $type;
			public $size;
			public $date;
			public $upload_image;
			public $tmp_path;
      public $image_placeholder = "https://placeholder.com/600x400&text=image";
			public $upload_directory = "images";
			public $errors = array();
			public $upload_errors_array = array(

			UPLOAD_ERR_OK           => "There is no error",
			UPLOAD_ERR_INI_SIZE	    => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
			UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
			UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
			UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
			UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
			UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
			UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."					
												
			);

			




			public function set_file($file){

			if (empty($file) || !$file || !is_array($file)) {

			$this->errors[] = "There was no file uploaded here.";
			return false;

			}elseif ($file['error'] !=0) {

			$this->errors[] = $this->upload_errors_array[$file['error']];
			return false;

			}else{

			$this->filename = basename($file['name']);		
			$this->tmp_path = $file['tmp_name'];
			$this->type     = $file['type'];
			$this->size     = $file['size'];
			
			

			}

			}

			public function update_photo(){
            
            if (!empty($this->errors)) {
            	
            	return false;
            }

          if(empty($this->filename) || empty($this->tmp_path)){

			$this->errors[] = "The file was not available";
			return false;

			}

			$target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->filename;

			if(file_exists($target_path)) {

			$this->errors[] = "The file {$this->filename} already exists";
			return false;

			}


			if(move_uploaded_file($this->tmp_path, $target_path)){

			unset($this->tmp_path);
			return true;			

			}else{

			$this->errors[] = "The file directory probably dose not have permission";
			return false;

			}


           }



           public function image_path_and_placeholder(){

           return empty($this->filename) ? $this->image_placeholder : $this->upload_directory.DS.$this->filename;
           }



		    public function picture_path(){

		    return $this->upload_directory.DS.$this->filename;

		    }

			public function save_images(){

			if ($this->id) {

			$this->update();

			}else{

			if(!empty($this->errors)) {

			return false;

			}


			if(empty($this->filename) || empty($this->tmp_path)){

			$this->errors[] = "The file was not available";
			return false;

			}


			$target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->filename;

			if(file_exists($target_path)) {

			$this->errors[] = "The file {$this->filename} already exists";
			return false;

			}


			if(move_uploaded_file($this->tmp_path, $target_path)){

			if($this->create()) {

			unset($this->tmp_path);
			return true;

			}

			}else{

			$this->errors[] = "The file directory probably dose not have permission";
			return false;

			}


			}


			}

       




			// public function delete_photo(){
          
            //  if ($this->delete()) {

            //  	$target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();

            //  	return unlink($target_path) ? true : false;
             	
            //  }else{

			// 	return false;
			// }

			// }

			// public function update_image(){


			// }




     public function comments(){

       return Comment::find_the_comments($this->id); 
     }


	public static function display_sidebar_data($photo_id) {


		$photo = Photo::find_by_id($photo_id);


		$output = "<a class='thumbnail' href='#'><img width='500' src='{$photo->picture_path()}' style='border-radius: 5px'></a> ";
		$output .= "<p>Image: {$photo->filename}</p>";
		$output .= "<p>Type: {$photo->type}</p>";
		$output .= "<p>Size: $photo->size</p>";

		echo $output;





	}


//    	public function formatBytes($size, $precision = 0){
//     $unit = ['Byte','MB'];

//     for($i = 0; $size >= 1024 && $i < count($unit)-1; $i++){
//         $size /= 1024;
//     }

//     return round($size, $precision).' '.$unit[$i];
// }

//     echo formatBytes('1876144', 2);




}

 ?>

