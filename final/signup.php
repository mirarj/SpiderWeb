<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SpiderWeb Movies - Sign Up</title>
<style>
</style>
<link rel='stylesheet' href='style.css'>
</head>

<body>

<header>
	<a href="./index.php"><img src="./images/swico.ico"></a>
	<form method="get" id="searchbar" action="search.php">
		<label for="em">Search</label>
		<input type='text' name='query'>
		<input type = "submit" value = "icon" />
	</form>
	<h1>Create Account</h1>
	<?php
	session_start();
	if (isset($_POST['logout'])) {
		session_destroy();
		echo '<script type="text/javascript">window.location = "signup.php"</script>'; // refresh page
	}
	if (isset($_SESSION['userid'])){
		echo "Logged in";
		echo "<form method='post' action='signup.php' class='loginout'><input type='submit' name='logout' value='Log Out'></form>";
	}
	else{
		echo "Not logged in";
		echo "<form method='get' action='login.php' class='loginout'><input type='submit' value='Log In'></form>";
	}	
	?>
</header>


<form method="post" id="form1" action="signup.php">
	<label for="em">Email</label> <br />
	<input type='text' name='email' id='em'><br>
	<label for="un">Username</label> <br />
	<input type='text' name='username' id='un'><br>
	<label for="pw">Password</label> <br />
	<input type='password' name='password' id='pw'><br>
	<input type = "submit" value = "Create Account" />
</form>
<?php

	if ($_POST) {
		//establish connection info	
		$server = "35.212.42.21";
		$userid = "uaqtg5oezskik";
		$pw = "talissqluser";
		$db = "db4qzjfvgwun4s";
		$conn = new mysqli($server, $userid, $pw, $db);

		$sql = "SELECT username, email FROM users";
		$result = $conn->query($sql);
		$continue = true;
		$un = $_POST['username'];
		// username cannot be an email
		$em = $_POST['email'];
		// validate email regex
		$pw = hash("sha256", $_POST['password']);
		foreach ($result as $rowid=>$rowdata) {
			if ($rowdata['username'] == $un) {
				echo "This username already exists. Please choose a different username or <a href='./login.php'>Log In</a> here.";
				// An account with this email address already exists. Please <a href='./login.php'>Log In</a> here.
				$continue = false;
			}
			if ($rowdata['email'] == $em) {
				echo "An account with this email address already exists. Please <a href='./login.php'>Log In</a> here.";
				$continue = false;
			}
		}
		if ($continue)
			{
				$sql = "INSERT INTO `users`(`id`, `username`, `password`, `email`) VALUES ('DEFAULT','".$un."','".$pw."','".$em."')";
				// echo $sql;
				$result = $conn->query($sql);
			}		

		$conn->close();

	}

?>

<script>
	form_obj = document.querySelector("#form1");

	form_obj.onsubmit = function() {
		alert("am i even here")
		<?php
		echo "document.write(php inside js?);"
		?>
	}
		document.write("regular doc write")
</script>

<a href='./login.php'><p>Login</p></a>

</body>
</html>
