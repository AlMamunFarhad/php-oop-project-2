<?php 



class User extends Db_object {


      protected static $db_table = "users";
      protected static $db_table_fields = array('id','username', 'password', 'firstname', 'lastname', 'user_image');
	public $id;
	public $username;
	public $password;
	public $firstname;
	public $lastname;
      public $user_image;
      public $upload_directory = "images";
      public $image_placeholder = "https://placeholder.com/600x400&text=image";



            public function update_photo(){
            
            if (!empty($this->errors)) {
                  
                  return false;
            }

          if(empty($this->user_image) || empty($this->tmp_path)){

                  $this->errors[] = "The file was not available";
                  return false;

                  }

                  $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->user_image;

                  if(file_exists($target_path)) {

                  $this->errors[] = "The file {$this->user_image} already exists";
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



      public function set_file($file){

      if (empty($file) || !$file || !is_array($file)) {

      $this->errors[] = "There was no file uploaded here.";
      return false;

      }elseif ($file['error'] !=0) {

      $this->errors[] = $this->upload_errors_array[$file['error']];
      return false;

      }else{

      $this->user_image = basename($file['name']);            
      $this->tmp_path   = $file['tmp_name'];
      $this->type       = $file['type'];
      $this->size       = $file['size'];
      
      

      }

      }


      // public function save_user_images(){


      // if(!empty($this->errors)) {

      // return false;

      // }


      // if(empty($this->user_image) || empty($this->tmp_path)){

      // $this->errors[] = "The file was not available";
      // return false;

      // }


      // $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->user_image;

      // if(file_exists($target_path)) {

      // $this->errors[] = "The file {$this->user_image} already exists";
      // return false;

      // }


      // if(move_uploaded_file($this->tmp_path, $target_path)){

      // if($this->create()) {

      // unset($this->tmp_path);
      // return true;

      // }

      // }else{

      // $this->errors[] = "The file directory probably dose not have permission";
      // return false;

      // }


 


      // }



      public function image_path_and_placeholder(){

      return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
      }


      public static function verify_user($username, $password){
      global $database;

      $username = $database->escape_string($username);
      $password = $database->escape_string($password);
      $sql = "SELECT * FROM ".static::$db_table." WHERE ";
      $sql .= "username = '{$username}' ";
      $sql .= "AND password = '{$password}' ";
      $sql .= "LIMIT 1";

      $the_result_array = static::find_by_query($sql);

	  return !empty($the_result_array) ? array_shift($the_result_array) : false;

      }

      public function picture_path(){

      return $this->upload_directory.DS.$this->user_image;

     }

     

     // public function ajax_save_user_image($user_image, $user_id){

     // global $database;

     // $user_image = $database->escape_string($user_image);
     // $user_id    = $database->escape_string($user_id);

     // $this->user_image = $user_image;
     // $this->id         = $user_id;

     // $sql = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";
     // $sql .=" WHERE id = {$this->id}";
     // $update_image = $database->query($sql);

     // echo $this->image_path_and_placeholder();

     // }


            public function ajax_save_user_image($user_image, $user_id) {


            global $database;

            $user_image = $database->escape_string($user_image);
            $user_id = $database->escape_string($user_id);

            $this->user_image = $user_image;
            $this->id         = $user_id;

            $sql  = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";
            $sql .= " WHERE id = {$this->id} ";
            $update_image = $database->query($sql);

            
            echo $this->image_path_and_placeholder();



      


      }




      public function delete_photo(){

      if ($this->delete()) {

      $target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();

      return unlink($target_path) ? true : false;

      }else{

      return false;

      }

      }





} // user class end












 ?>