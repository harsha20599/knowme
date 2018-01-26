<!DOCTYPE html>
<html>
<head>
	<title>Checking Details...</title>
</head>
<body>
<?php
	

	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	@session_start();
	// $uname = 1;
	$servername = "localhost";
	$unm = "root";
	$password = "";
	$dbname = "knowme";

	// Create connection 
	$conn = mysqli_connect($servername, $unm, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$result =mysqli_query($conn,"SELECT `fullname` FROM `data` WHERE `username` = '$username'");
	
	if (mysqli_num_rows($result) > 0)
	{		
		header("Location: http://localhost/knowme/knowme/index.php?notexist=3");
	}
	else{
		$_SESSION["username"] = $username;
		$sql = "INSERT INTO `data` (username,fullname)
		VALUES ('$username', '$fullname')";

		if ($conn->query($sql) === TRUE) {
		    echo "login success";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		echo '<form action="create.php" id="formi" method="POST">
			<input type="hidden" name="username" value = "'.$username.'">
			<input type="hidden" name="fullname" value = "'.$fullname.'">
		</form>
		<script> 
			window.setTimeout(myFunction,0);
			function myFunction(){
				document.getElementById("formi").submit();
			}
		</script>';
	}
?>

</body>
</html>
