<?php
		include('functions.php');
	//start session
	session_start();	
	//get username and password from $_POST
	$name = sanitizeString($_POST["name"]);
	$username = sanitizeString($_POST["username"]);
	$password = md5($_POST["password"]);
	$gendr = sanitizeString($_POST["gender"]);
	$question = sanitizeString($_POST["question"]);
	$answer = sanitizeString($_POST["answer"]);
	$email = sanitizeString($_POST["email"]);
	$dob = sanitizeString($_POST["dob"]);
	$location = sanitizeString($_POST["location"]);
	$profile_pic = sanitizeString($_POST["profile_pic"]);
	
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
	if(1){
		//If authenticated: say hello!
		$_SESSION["username"] = $username;
		header("Location: feed.php");
	}else{
		//else ask to login again..	
		echo "Invalid password! Try again!";
		echo $result;
	}
?>