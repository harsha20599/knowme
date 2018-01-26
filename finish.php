<!doctype HTML>

<!-- head -->

<html lang="en">
<head>
	<title>Know me</title>
	
	<!-- meta -->
	<meta charset=utf-8>
	<meta name="description" content="BareCSS template file">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
	<link href="style.css" rel="stylesheet">
	<!-- css -->
	
	<link href="css/bare.min.css" rel="stylesheet">
</head>

<!-- body -->

<body>
<?php
	$score = $_POST['score'];
	$user = $_POST['username'];
	$fname = $_POST['friendname'];

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
	
	$result =mysqli_query($conn,"SELECT `leaderboard` FROM `data` WHERE `username` = '$user'");
	
	if (mysqli_num_rows($result) > 0)
	{		
			while($row = mysqli_fetch_assoc($result)) {
		   		$leadtable = $row['leaderboard'];		               
		    }

	}else{
		echo "sorry the link doesn't exists anymore";
		return;
	}
	$newGuy = new stdClass();
	
	$newGuy->name = $fname;
	$newGuy->score = $score;
	if(is_null($leadtable) ){
			
		$dt = new stdClass();
		$dt->data = array(array("name" => "$fname","score" => $score));
		$fdt = json_encode($dt);

		$sql = "UPDATE `data` SET `data`.`leaderboard` = '$fdt' WHERE `data`.`username`= '$user'";
		

	}
	else{
		$values = json_decode($leadtable);
		array_push($values->data, $newGuy);
		$jsonData = json_encode($values);
		
		$sql = "UPDATE `data` SET `data`.`leaderboard` = '$jsonData' WHERE `data`.`username`= '$user'";
	}	
	if (!mysqli_query($conn, $sql)) {
		echo "Sorry There was a problem";
	 }

?>	
<!-- nav -->
<nav><!-- use fx attribute for fixed positioning -->
	<label>
		<input type="checkbox">
		<header>
			<a href="#"><b>Know</b>me</a>
		</header>
		
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="about.php">About</a></li>
			<li>
				<a>Feedback</a>
				<menu>
					<menuitem><a href="contactus.php">Contact Us</a></menuitem>
					<!-- <menuitem><a href="#four">Facebook</a></menuitem>
					<menuitem><a href="#five">Instagram</a></menuitem> -->
				</menu>
			</li>
		</ul>
	</label>
</nav>


<!-- standard section for content -->

<section id="bg">
	<h4 id="usertitle">Thank You for participating</b></h4>
</section>
<section id="question">
		<blockquote><h3>Your Score is <?php echo $score; ?>/5<h3></blockquote>
</section>
<section style="margin-top: -20px;">
	

	<grid>
		
		<div txt="c" fx col="1/1" ><a href="index.html"><button id="btnnext" primary round>Create Your's</button></a></div>
	</grid>
</section>
<section txt="c">
	<h5 style="font-size: 20px;">The Leaderboard</h5>
	
			<?php
				$result =mysqli_query($conn,"SELECT `leaderboard` FROM `data` WHERE `username` = '$user'");
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

			?>

	<!-- 	</tbody>

	</table> -->

</section>




</body>

</html>