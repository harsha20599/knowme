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
	

	$uname = $_POST['username'];
	if (!isset($_POST['username'])){
		header("Location: http://localhost/knowme/knowme/index.php?notexist=2");
	}
	$fname = $_POST['friendname'];
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
	$sql = "SELECT `fullname` FROM `data` WHERE id = 1";
	$result = $conn->query($sql);
	$result =mysqli_query($conn,"SELECT `fullname`,`question1`, `question2`, `question3`, `question4`, `question5` FROM `data` WHERE `username` = '$uname'");
	
	if (mysqli_num_rows($result) > 0)
	{		
			while($row = mysqli_fetch_assoc($result)) {
		   		$fullname = $row['fullname'];
		   		$q1 = $row['question1'];
		   		$q2 = $row['question2'];
		   		$q3 = $row['question3'];
		   		$q4 = $row['question4'];
		   		$q5 = $row['question5'];
		               
		    }
		
	}

?>
<!-- nav -->
<div id="inset_form"></div>
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
	<h4 id="usertitle">How much you know about <b><?php echo "$fullname"; ?></b></h4>
</section>
<section id="question">
	<h4 id="questionNumber">Question 1</h4>
	<blockquote><h5 id="question1">who is Harsha's favourite hero </h5></blockquote>
	<input type="radio"  name="radio" id="radio-1" value="1"> <label for="radio-1" id="option1">Mahesh Babu</label><br>
	<input type="radio"   name="radio" id="radio-2" value="2"> <label for="radio-2" id="option2">Chiranjeevi</label><br>
	<input type="radio"  name="radio" id="radio-3" value="3"> <label for="radio-3" id="option3">Ram Charan</label><br>
	<input type="radio"  name="radio" id="radio-4" value="4"> <label for="radio-4" id="option4">Varun</label>
</section>
<section style="margin-top: -20px;">
	

	<grid>
		<div txt="c" fx col="1/2" ><button id="btnback" round>Back</button></div>
		<div txt="c" fx col="1/2" ><button id="btnnext" onclick="loadNextQuestion();" primary round>Next</button></div>
	</grid>
<form action="finish.php" method="POST" id="formi">
	<input type="hidden" id="uoption" name="username" value="<?php echo $uname ?>">
	<input type="hidden" id="foption" name="friendname" value="<?php echo $fname ?>">
	<input type="hidden" id="soption" name="score">

</form>
</section>




<script type="text/javascript">
	var score = 0;
	var questionIndex = 0;
	var obj1 = JSON.parse('<?php echo $q1 ?>');
	var obj2 = JSON.parse('<?php echo $q2 ?>');
	var obj3 = JSON.parse('<?php echo $q3 ?>');
	var obj4 = JSON.parse('<?php echo $q4 ?>');
	var obj5 = JSON.parse('<?php echo $q5 ?>');

	 var data = {questions : [obj1 , obj2 , obj3 , obj4, obj5]};
	
	console.log(data);


	function shuffle(array) {
	  var currentIndex = array.length, temporaryValue, randomIndex;

	  // While there remain elements to shuffle...
	  while (0 !== currentIndex) {

	    // Pick a remaining element...
	    randomIndex = Math.floor(Math.random() * currentIndex);
	    currentIndex -= 1;

	    // And swap it with the current element.
	    temporaryValue = array[currentIndex];
	    array[currentIndex] = array[randomIndex];
	    array[randomIndex] = temporaryValue;
	  }

	  return array;
	}



	function loadQuestion(questionIndex) {
		var arr1 = ["1", "2", "3", "4"];

		arr1 = shuffle(arr1);

		var questionTitle = document.getElementById("question1");
		var optionOne = document.getElementById("option"+arr1[0]);
		var optionOneValue = document.getElementById("radio-"+arr1[0]);
		var optionTwo = document.getElementById("option"+arr1[1]);
		var optionTwoValue = document.getElementById("radio-"+arr1[1]);
		var optionThree = document.getElementById("option"+arr1[2]);
		var optionThreeValue = document.getElementById("radio-"+arr1[2]);
		var optionFour = document.getElementById("option"+arr1[3]);
		var optionFourValue = document.getElementById("radio-"+arr1[3]);
		var qno = document.getElementById("questionNumber");
		if(questionIndex < 5)
		{
			qno.innerHTML = "Question " + (questionIndex+1);
			questionTitle.innerHTML = data.questions[questionIndex].question1;
			optionOne.innerHTML = data.questions[questionIndex].c;
			optionOneValue.value = 1;
			optionTwo.innerHTML = data.questions[questionIndex].w1;
			optionTwoValue.value = 2;
			optionThree.innerHTML = data.questions[questionIndex].w2;
			optionThreeValue.value = 3;
			optionFour.innerHTML = data.questions[questionIndex].w3;
			optionFourValue.value = 4;
		}

	}

	function loadNextQuestion() {

		questionIndex++;
		var selectedOption = document.querySelector('input[type=radio]:checked');
		if(!selectedOption){
			alert("please select any option");
			return;
		}
		var answer = selectedOption.value;
		if(selectedOption.value == 1){
			score++;	
		}
		selectedOption.checked = false;

		if(questionIndex+1 == 5){

			document.getElementById('btnnext').textContent = 'finish';
			
		}
		if(questionIndex == 5) {
			// var u = '<?php  $uname ?>';
			// var f = '<?php $fname ?>';
		 //    window.location.href = "finish.php?sc="+score+"&username="+u+"&friendname="+f;
			document.getElementById("soption").value = score;
			window.setTimeout(myFunction, 200);
			function myFunction(){
				document.getElementById("formi").submit();
			}
		    return;

		}
		loadQuestion(questionIndex);

	}
	loadQuestion(0);

</script>
</body>

</html>