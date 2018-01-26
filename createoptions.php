<?php

session_start();

?><!doctype HTML>

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

	if (isset($_POST['question']) && $_POST['question']!= "" ) {

		$question = $_POST['question'];
	}
	elseif (isset($_POST['radio'])) {

		$question = $_POST['radio'];

	}

	if (isset($_SESSION['username']) && isset($_POST['id']) && isset($question)){
		$username = $_SESSION['username'];
		$id = $_POST['id'];
		// $question = addslashes($question);
		$printq = $question;

	}else
	{
		echo "sorry there seems to be an error";
		// header("Location: http://localhost/knowme/knowme/index.php?notexist=3");
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
	<h4 id="usertitle"><?php echo "$id".". "."$printq"; ?></h4>
</section>
<section id="question">
<form onsubmit="return validate(this);" method="POST" id="formi">

	<h4>The Correct Answer</h4>
	<input type="text" id="opt1" name="c" placeholder="Your Correct Answer">
	<input type="hidden" name="question" value="<?php echo $question ?>">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<h4>Create Your Options</h4>
	<input type="text" name="w1" id="opt2" placeholder="Enter the wrong guess">
	<input type="text" name="w2" id="opt3" placeholder="Enter the wrong guess">
	<input type="text" name="w3" id="opt4" placeholder="Enter the wrong guess">

</section>
<section style="margin-top: -20px;">
	

	<grid>
		<div txt="c" fx col="1/2" ></div>
		<div txt="c" fx col="1/2" ><button id="btnnext" primary round>Next</button></div>
	</grid>

</section>


</form>
<script type="text/javascript">
	   
	function validate() {
		var t1 = document.getElementById("opt1").value;
		var t2 = document.getElementById("opt2").value;
		var t3 = document.getElementById("opt3").value;
		var t4 = document.getElementById("opt4").value;

		if ( (t1 == "") || (t2 == "") || (t3 == "") || (t4 == "" ) ){
                alert('Please complete the field');
                return false;
        }else{
        	document.getElementById('formi').action = "create.php";
        	return true;
        }
	}

</script>

</body>

</html>