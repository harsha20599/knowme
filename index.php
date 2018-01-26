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
	

	// $uname = 1;
	if (isset($_GET['notexist'])){
		$notexist = $_GET['notexist'];
	
		if ($notexist == 1) {
			$error = "Seems the username doesn't exist anymore";
		}elseif ($notexist == 2) {
			$error = "Apologies, the servers are little busy. Please try again";
		}elseif ($notexist == 3) {
			$userfail = "Sorry the username is already taken. Please choose another username";
		}elseif($notexist == 4){
			$userfail = "Oops, it's a technical error. Please try again";
		}
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
<form action="#" method="POST" id="mform">
<?php 
	if (isset($error)){ 
		echo '<section><h5 >'. $error.'</h5></section>';
	}
?>

<section id="bg">
	<h4 id="usertitle">Let you know how much <b> your friends</b> know about you</b></h4>
</section>
<section id="question">
		<input type="text" id="tfname" placeholder="Enter Your Name" name="fullname">
		<input type="text" id="tuname" placeholder="Give a username to create link" name="username">
		<?php 
			if (isset($userfail)){ 
				echo '<span style="color: red;">'.$userfail .' </span>';
				
			}
		?>
</section>

<!-- 	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<ins class="adsbygoogle"
		     style="display:block; text-align:center;"
		     data-ad-layout="in-article"
		     data-ad-format="fluid"
		     data-ad-client="ca-pub-8002725649656946"
		     data-ad-slot="7709892969"></ins>
		<script>
		     (adsbygoogle = window.adsbygoogle || []).push({});
	</script> -->

<section style="margin-top: -20px;">
	

</form>
	<grid>
		
		<div txt="c" fx col="1/1" ><button id="btnnext" onclick="validate();" primary round>Let's Create</button></div>
	</grid>
</section>
<script type="text/javascript">
	function validate() {
		var fname = document.getElementById('tfname');
		var uname = document.getElementById('tuname');
		if(fname.value == "" || uname.value == ""){
			alert("please fill the details")
		}else{
			document.getElementById('mform').action = "check.php";
			document.getElementById('mform').submit;
		}
	}

</script>


</body>

</html>