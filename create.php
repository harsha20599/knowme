<?php
session_start();
?>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!-- css -->
	
	<link href="css/bare.min.css" rel="stylesheet">
</head>

<!-- body -->

<body>
<?php

	if(!isset($_SESSION['username'])){
		header("Location: http://localhost/knowme/knowme/index.php?notexist=4");
	}
	
	if (isset($_POST['question']) && isset($_POST['c']) && isset($_POST['w1']) &&isset($_POST['w2']) && isset($_POST['w3']) && isset($_POST['id'])) {

		if($_POST['id'] == 5 || $_POST['id'] == '5'){
			echo '<form action="share.php" id="formi" method="POST">
				<input type="text" name="username" value = " ">
			</form>
			<script> 
				window.setTimeout(myFunction);
				function myFunction(){
					document.getElementById("formi").submit();
				}
			</script>';
			
			

		}

		$username = $_SESSION["username"];
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

		$m = new stdClass();

		$m->question1 = $_POST['question'];
		$m->c = $_POST['c'];
		$m->w1 =  $_POST['w1'];
		$m->w2 = $_POST['w2'];
		$m->w3 = $_POST['w3'];
		
		$index = $_POST['id'];
		$questionFinal = 'question'.$index;
		// $dt = htmlspecialchars(json_encode($m), ENT_QUOTES, 'UTF-8');

		$dt = json_encode($m);

		$sql = "UPDATE `data` SET `data`.`$questionFinal` = '$dt' WHERE `data`.`username`= '$username'";

		if (!mysqli_query($conn, $sql)) {
			echo "Sorry There was a problem ".mysqli_error($conn);
		 }

		$index = $index+1;

		
	}else{

		$index = 1;
	}
	if($index == 3){
		$al =  "2 more questions left, please dont't quit";
	}elseif ($index == 4) {
		$al =  "You are reaching to end, One more to go";
	}elseif ($index == 5) {
		$al =  "Thanks for your time, This is the last question";
	}
	else{
		$al = 	"Let you know how much they know about you";
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
	<h4 id="usertitle"><?php echo $al; ?></h4>
</section>

<form action="#" onsubmit="return next(this);" method="POST" id="forum">

<section id="question">

	<h4>Create Your Question <?php echo "$index"; ?></h4>
	<input type="text" name="question" id="qqq" placeholder="Enter Your Question or Choose from below">
	<input type="hidden" name="id" value="<?php echo $index ?>">
	<?php
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

		$result =mysqli_query($conn,"SELECT `qdata1`, `qdata2`, `qdata3`, `qdata4` FROM `qdata` WHERE `id` = '$index'");

		if (mysqli_num_rows($result) > 0)
		{		
			while($row = mysqli_fetch_assoc($result)) {
		   		$qdata1 = $row['qdata1'];		               
		   		$qdata2 = $row['qdata2'];		               
		   		$qdata3 = $row['qdata3'];		               
		   		$qdata4 = $row['qdata4'];		               
		    }
		}	


	 ?>
	<input type="radio" name="radio" id="radio-1" value="<?php echo $qdata1 ?>"> <label for="radio-1"><?php echo $qdata1 ?></label><br>
	<input type="radio" name="radio" id="radio-2" value="<?php echo $qdata2 ?>"> <label for="radio-2"><?php echo $qdata2 ?></label><br>
	<input type="radio" name="radio" id="radio-3" value="<?php echo $qdata3 ?>"> <label for="radio-3"><?php echo $qdata3 ?></label><br>
	<input type="radio" name="radio" id="radio-4" value="<?php echo $qdata4 ?>"> <label for="radio-4"><?php echo $qdata4 ?></label>
</section>
<section style="margin-top: -20px;">
	

	<grid>
		<div txt="c" fx col="1/2" ></div>
		<div txt="c" fx col="1/2" ><button id="btnnext" primary round>Next</button></div>
	</grid>

</section>

</form>
<script type="text/javascript">
	function next() {
		var qs = document.getElementById("qqq").value;

		if ($('input[name=radio]:checked').length > 0 || qs != "") {
			qs = qs.replace(/["']/g, "");
			document.getElementById("qqq").value = qs;
			document.getElementById("forum").action = "createoptions.php";
			return true;			
			// document.getElementById("forum").submit;
	    	
		}else{
			alert("please enter or choose any option");
			return false;
		}

	}

</script>

 </body>

</html>