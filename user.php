<?php
  include "Crud.php";
  include "authenticator.php";
  class User implements Crud,Authenticator {
  	private $user_id;
  	private $first_name;
  	private $last_name;
  	private $city_name;
    private $username;
	private $password;
	private $prof_img;
	private $utc_timestamp;
	private $time_zone_offset;
/*We can use the class constructor to initialize our values 
member variables cannot be instantiated from elsewhere; They private*/
  	function __construct (){
  		  
	  }
	  //Static method to access it witha class rather than an object.
	 /*Static constructor*/ 
	  public static function create() {
		  $instance = new self () ;
		  return $instance;
	  }

	  //username setter
	  public function setUsername($username){
		$this->username = $username;
	}

	//username getter
	  public function getUsername(){
		return $this->username;
	}

	//password setter
	public function setPassword($password){
		$this->password = $password;
	}

	//password getter
	public function getPassword(){
		return $this->password;
	}
	  
	//user_id setter
  	public function setUserId($user_id){
  		$this->user_id = $user_id;
  	}
	 
	  //user_id getter
     public function getUserId(){
  		return $this->user_id;
  	}

	//first_name setter
	public function setFirstName($first_name){
		$this->first_name = $first_name;
	}
	   
	//first_name getter
	public function getFirstName(){
		return $this->first_name;
		}
		
	//last_name setter
	public function setLastName($last_name){
		$this->last_name = $last_name;
	}
   
	//last_name getter
   public function getLastName(){
		return $this->last_name;
	}

	//city_name setter
	public function setCityName($city_name){
		$this->city_name = $city_name;
	}
   
	//city_name getter
   public function getCityName(){
		return $this->city_name;
	}

	//prof_img setter
	public function setProfileImage($prof_img){
		$this->prof_img = $prof_img;
	}
	   
	//prof_img getter
	public function getProfileImage(){
		return $this->prof_img;
	}
		
	//utc_timestamp setter
	public function setUtcTimestamp($utc_timestamp){
	 $this->utc_timestamp = $utc_timestamp;
	}

	//utc_timestamp getter
	public function getUtcTimestamp(){
		return $this->utc_timestamp;
	}

	//Offset setter
	public function setOffset($time_zone_offset){
		$this->time_zone_offset = $time_zone_offset;
	}

	//utc_timestamp getter
	public function getOffset(){
		return $this->time_zone_offset;
	}


      public function save(){
      	$db = mysqli_connect("localhost","root","","btc3205");

  		$fn = $this->first_name;
  		$ln = $this->last_name;
	    $city = $this->city_name;
		$uname= $this->username;

		$this->hashPassword();
		$pass=$this->password;

		$utc = $this->utc_timestamp;
		$offset = $this->time_zone_offset;

  		$res = mysqli_query($db,"INSERT INTO user(first_name,last_name,user_city,username,password,utc,offset) VALUES ('$fn','$ln','$city','$uname','$pass','$utc','$offset')") OR die("Error".mysqli_error($db));
  		return $res;
  	}

  	  public function readAll(){
			return null;
		 	/*$db = mysqli_connect("localhost","root","","btc3205");
		  $res=mysqli_query($db,"SELECT * FROM users");

		  if(mysqli_num_rows($res)>0){
			  while($row=mysqli_fetch_assoc($res)){
				  echo "<br>".$row['id']. " | ".$row['first_name']." | ".$row['last_name']." | ".$row['user_city']."<br>";
			  }
		  }else{
			  echo "The database is empty";
		  }

		  $db->closeDatabase();*/
	  
	  }

  	public function readUnique(){
          return null;
  	}

  	public function search(){
       return null;
  	}

  	public function update(){
  		return null;

  	}

     public function removeOne(){
     	return null;
    }

     public function removeAll(){
     	return null;

	 }

	 public function isUserExist()
	 {
		$db = mysqli_connect("localhost","root","","btc3205");
		 $con = new DBConnector;
 
		 $res = mysqli_query($db, "SELECT * FROM user") or die("Error: ".mysqli_error());
 
		// $con->closeDatabase();
 
		 while ($row = $res->fetch_assoc()) {
			 if ($this->username == $row['username']) {
				 return true;
			 }
		 }
		 return false;
	 }
 
	 
	 public function validateForm(){
		  //Return true if the values are not empty
		  $fn = $this->first_name;
		  $ln = $this->last_name;
		  $city = $this->city_name;
		  $uname= $this->username;
		  $pass=$this->password;
 
		  if($fn == "" || $ln == "" || $city == "" || $uname == "" || $pass=""){
			  return false;
		  }
		   return true;
	 }

	 public function createFormErrorSessions(){
		
		 session_start();
		 $_SESSION['form_errors'] = "All fields are required";
	 }

	 public function hashPassword(){
		 //inbuilt function password_hash hashes our password
		 $this->password = password_hash($this->password,PASSWORD_DEFAULT);
	 }

	 public function isPasswordCorrect(){
		$db = mysqli_connect("localhost","root","","btc3205");

		 $con = new DBConnector;
		 $found = false;
		 $res = mysqli_query($db,"SELECT * FROM user") or die ("Error" . mysqli_error());
		 
if(mysqli_num_rows($res)>0){
		 while($row=mysqli_fetch_array($res)){
			 if(password_verify($this->getPassword(), $row['password']) && $this->getUsername() == $row ['username']){
				 $found = true;
			 }
		 }
		}
//Close database connection
		 //$con->closeDatabase();
		 return $found;
		 
	 }
        public function login(){
			if($this->isPasswordCorrect()){
				
				//password is correct, so we load the protected page
				header("Location:private_page.php");
			}
		}

		public function createUserSessions(){
			session_start();
			$_SESSION['username'] = $this->getUsername();
		}

		public function logout(){
			session_start();
			unset($_SESSION['username']);
			session_destroy();
			header("Location:lab1.php");
		}
  }
?>