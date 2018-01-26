<!doctype HTML>

<!-- head -->

<html lang="en">
<head>
	<title>Know me</title>
	
	<!-- meta -->
	<meta charset=utf-8>
	<meta name="description" content="BareCSS template file">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
	<link href="../style.css" rel="stylesheet">
	<!-- css -->
	
	<link href="../css/bare.min.css" rel="stylesheet">
</head>

<!-- body -->

<body>
	
<!-- nav -->

<?php
	

	$uname = $_GET['u'];
	// $uname = 1;
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "knowme";

	// Create connection 
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	// $sql = "SELECT `fullname` FROM `data` WHERE id = 1";
	// $result = $conn->query($sql);
	$result =mysqli_query($conn,"SELECT `fullname` FROM `data` WHERE `username` = '$uname'");
	
	if (mysqli_num_rows($result) > 0)
	{		
			while($row = mysqli_fetch_assoc($result)) {
		   		$fullname = $row['fullname'];
		               
		    }

	}
	else{
		header("Location: http://localhost/knowme/knowme/index.php?notexist=1");
	}
?>
<nav><!-- use fx attribute for fixed positioning -->
	<label>
		<input type="checkbox">
		<header>
			<a href="#"><b>Know</b>me</a>
		</header>
		
		<ul>
			<li><a href="../index.php">Home</a></li>
			<li><a href="../about.php">About</a></li>
			<li>
				<a>Feedback</a>
				<menu>
					<menuitem><a href="../contactus.php">Contact Us</a></menuitem>
					<!-- <menuitem><a href="#four">Facebook</a></menuitem>
					<menuitem><a href="#five">Instagram</a></menuitem> -->
				</menu>
			</li>
		</ul>
	</label>
</nav>


<!-- standard section for content -->
<form action="../questions.php" method="POST">

<section id="bg">
	<h4 id="usertitle">How much you know about <br> <b><?php echo $fullname ?></b></h4>
</section>
<section id="question">

		<input type="text" placeholder="Enter Your Name" name="friendname">
		<input type="hidden" name="username" value="<?php echo $uname; ?>">
		<!-- <input type="text" placeholder="Create username"> -->
</section>
<section style="margin-top: -20px;">
	

	<grid>
		
		<div txt="c" fx col="1/1" ><button id="btnnext" primary round>Let's Start</button></div>
	</grid>
</section>

</form>
<section txt="c">
	<h5 style="font-size: 20px;">The Leaderboard</h5>
				<?php
				$result =mysqli_query($conn,"SELECT `leaderboard` FROM `data` WHERE `username` = '$uname'");
				if (mysqli_num_rows($result) > 0)
				{		
						while($row = mysqli_fetch_assoc($result)) {
					   		$leadtable = $row['leaderboard'];		               
					    }
				}else{
					echo "Sorry, We cannot  found any results";
					return;
				}
				$table = json_decode($leadtable);
				if(isset($table->data)){
				
					$rows = count($table->data);
						echo "	<table>
						<thead>
							<tr><th>Name</th><th>Score</th></tr>

						</thead>
						<tbody>";
								for($i=0;$i<$rows;$i++){
									$name = $table->data[$i]->name;
									$score = $table->data[$i]->score;
									echo "<tr> <td> ".$name." </td> <td>".$score." / 5</td> </tr>";
								}
								echo "
						</tbody>

					</table>";
				}

			?>

</section>




</body>

</html>