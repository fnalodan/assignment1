<!DOCTYPE html>
<html>
<head>
	<title>MyFacebook Feed</title>
</head>
<body>
<?php
	include('database.php');
	
	session_start();

	$conn = connect_db();

	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	//user information 
	$row = mysqli_fetch_assoc($result);
	$name = $row['Name'];
	echo "<h1>Welcome back ".$name."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";

	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content'>Say something...</textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<p><input type='submit'></p>";	
	echo "</form>";

	echo "<br>";

	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);

	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}

	//show all posts on myfacebook
	for($i = 0; $i < $num_of_rows; $i++){

		$row = mysqli_fetch_row($result_posts);
		echo "$row[3] said $row[1] ($row[5])";
		echo "<form action='likes.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> <input type='submit' value='Like'></form>";
		echo "<br> Comments:<br>";
		//show comments loop
		//to print all comments assosiated with a single post
		$comments = mysqli_query($conn, "SELECT * FROM comments WHERE post_id = $row[0]");
		$num_of_rows_comments = mysqli_num_rows($comments);
		if( $num_of_rows_comments > 0){
			for($j = 0; $j < $num_of_rows_comments; $j++){
				$commentArray = mysqli_fetch_row($comments);
				echo "$commentArray[3] @ $commentArray[4] : <br>$commentArray[1]<br>";		
			}
		}
		//comments box
		//echo "a";
		echo "<form  method='POST' action='comments.php'>";
		echo "<p><textarea name='comment'>Comment! </textarea></p>";
		echo "<input type='hidden' name='PID' value='$row[0]'>";
		echo "<input type='hidden' name='name' value='$name'>";
		echo "<input type='submit' value='comment!'></form><br><br><br>";
		

	}

?>


</body>
</html>
