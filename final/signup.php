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

<h1>Create Account</h1>


<form method="post" id="form1" action="signup.php">
	<label for="em">Email</label> <br />
	<input type='text' name='email' id='em'><br>
	<label for="un">Username</label> <br />
	<input type='text' name='username' id='un'><br>
	<label for="pw">Password</label> <br />
	<input type='password' name='password' id='pw'><br>
	<input type = "submit" value = "Create Account" />

	<?php
	//establish connection info
	$server = "35.212.65.183";
	$userid = "u0qw5mzxxutfs";
	$pw = "k1nwmps94r8z";
	$db = "dbg1zmcxmgjkkw";
	$conn = new mysqli($server, $userid, $pw, $db);

	if ($_POST) {
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
</form>

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
