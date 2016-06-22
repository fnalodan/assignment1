<?php
		
	//start session
	session_start();	
	//get username and password from $_POST
	$name = $_POST["name"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$gendr = $_POST["gender"];
	$question = $_POST["question"];
	$answer = $_POST["answer"];
	$email = $_POST["email"];
	$dob = $_POST["dob"];
	$location = $_POST["location"];
	$profile_pic = $_POST["profile_pic"];
	
	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$result = mysqli_query($conn, "INSERT INTO users (`Username`, `Password`, `Name`, `email`, `dob`, `gender`, `verification_question`, `verification_answer`, `location`, `profile_pic`) VALUES ('$username','$password','$name','$emai','$dob','$gendr','$question','$answer','$location','$profile_pic')");
	$num_of_rows = mysqli_num_rows($result);
	//Check in the DB
	if($num_of_rows > 0){
		//If authenticated: say hello!
	//	$_SESSION["username"] = $username;
	//	header("Location: feed.php");
		//echo "Success!! Welcome ".$username;
	}else{
		//else ask to login again..	
		echo "Invalid password! Try again!";
		echo $result;
	}
?>