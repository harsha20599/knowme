<!doctype HTML>

<!-- head -->

<html lang="en">
<head>
	<title>Know me</title>
	
	<!-- meta -->
	<meta charset=utf-8>


	<meta name="description" content="Let you know how much your friends know about you">
	<meta property="og:title" content="know about your friends" />
	<meta property="og:url" content="https://www.knowme.ml" />
	<meta property="og:description" content="Let you know how much your friends know about you">
	<meta property="og:type" content="article" />
	<meta property="og:locale" content="en_GB" />
	<meta property="og:image" content="http://www.knowme.ml/webpage_300x200.png">
	<link rel="shortcut icon" href="favicon.ico"/>


	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
	<link href="style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- css -->
	
	<link href="css/bare.min.css" rel="stylesheet">
</head>

<!-- body -->

<body>
	

<?php
	session_start();
	if (isset($_SESSION['username']) ){
		$username = $_SESSION['username'];
		$username = "http://www.knowme.ml/u/".$username;
		
		

	}else
	{
		// echo "sorry there seems to be an error";
		// header("Location: http://localhost/knowme/knowme/index.php?notexist=4");
	}
	session_destroy();


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
	<h4 id="usertitle">Time to share. Check who knows you well</h4>
</section>
<section id="question">
	<h5>Here's your link</h5>
	<grid>
		<div fx col="11/12" >
			<input type="text" placeholder="Enter Your Name" id="link" value="<?php echo $username ?>">
		</div>
		<div fx col="1/12" >
			<i class="glyphicon glyphicon-copy" onclick="copytext();" style="margin-top: 10px;"></i>
		</div>
	</grid>
</section>
<section style="margin-top: -20px;">
	
	<grid>
		
		<div txt="c" fx col="1/1" ><a class="magic" href="whatsapp://send?text=<?php echo($username) ?>" data-action="share/whatsapp/share"><button id="btnwhatsapp" primary round>Share On Whatsapp</button></a></div>
	</grid>
</section>


<script>
	function copytext() {
	  var copyText = document.getElementById("link");
	  copyText.select();
	  document.execCommand("Copy");
	  alert("Copied the link" + copyText.value);
	}
</script>

</body>

</html>