<?php
	
	session_start();

	include('database.php');


	//Get data from the form
	$content = $_POST['comment'];
	$PID = $_POST['PID'];
    $name = $_POST['name'];
	//connect to DB
	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$PID'");
	$row = mysqli_fetch_assoc($result);

		
	
	$user_id = $row["UID"];
    $time = time();
    
	echo "$name".$user_id.$content.$PID.$time."\n";
    
	$result_insert = mysqli_query($conn, "INSERT INTO comments (post_id, comment, user_id, user_name, time) VALUES ($PID, '$content', '$user_id', '$name', now())");
  //  INSERT INTO `comments`(`post_id`, `comment`, `user_id`, `user_name`, `time`) VALUES ()
    echo $result_insert;
	//check if insert was okay
	if($result_insert){

		//redirect to feed page 
		header("Location: feed.php");

	}else{
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";
	}

 

?>