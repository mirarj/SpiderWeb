<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SpiderWeb Movies - Log In</title>
<style>
</style>
<link rel='stylesheet' href='style.css'>
</head>

<body>

<!-- password for mjain02 is "mypassword" -->
<?php
	include('./header.php');
	makeHeader('login.php', 'Log In');
?>

<?php

	$helptext = "<p id='help'>Don't have an account? <a href='./signup.php'>Sign up here</a>.</p>";
	$errortext = "<p id='error'></p>";
	if ($_POST) {
		//establish connection info
		$server = "35.212.42.21";
		$userid = "uaqtg5oezskik";
		$pw = "talissqluser";
		$db = "db4qzjfvgwun4s";
		$conn = new mysqli($server, $userid, $pw, $db);
	
		$sql = "SELECT username, email FROM users";
		$result = $conn->query($sql);
		$found = false;
		$unem = $_POST['username'];
		$pw = hash("sha256", $_POST['password']);
		foreach ($result as $rowid=>$rowdata) {
			if ($rowdata['username'] == $unem) {
				$found = true;
				$sql = "SELECT password FROM users WHERE username='".$unem."'";
				$result2 = $conn->query($sql);
				foreach ($result2 as $rowid2=>$rowdata2) {
					if ($pw == $rowdata2['password']) {
						$_SESSION['userid'] = $unem;
						// echo "success, redirect to profile page for ".$_SESSION['userid'];
						// header('profile.php');
						echo '<script type="text/javascript">window.location = "profile.php"</script>';
					}
					else {
						echo "<p id='error'>Incorrect password.</p>";
					}
				}
			}
			else if ($rowdata['email'] == $unem) {
				$found = true;
				$sql = "SELECT password, username FROM users WHERE email='".$unem."'";
				$result2 = $conn->query($sql);
				foreach ($result2 as $rowid2=>$rowdata2) {
					if ($pw == $rowdata2['password']) {
						$_SESSION['userid'] = $rowdata2['username'];
						// echo "success, redirect to profile page for ".$_SESSION['userid'];
						// header('profile.php');
						echo '<script type="text/javascript">window.location = "profile.php"</script>';
					}
					else {
						$errortext = "<p id='error'>Incorrect password.</p>";
					}

				}
			}
		}

		if (!$found) {
			$helptext = "<p id='help'>We don't have an account with this email address or username. Please <a href='./signup.php'>Create an account</a> here.</p>";
		}

		$conn->close();
	
	}

?>
<div class='login'>
<form method="post" id="login_form" class='ls' action="login.php">
	<label for="un">Username/Email</label>
	<input type='text' name='username' id='un'>
	<label for="pw">Password</label>
	<input type='password' name='password' id='pw'>
	<?php
	echo $errortext;
	?>
	<input type = "submit" value = "Log In" />
</form>
<?php
	echo $helptext;
?>


<script>


	form_obj = document.querySelector("#login_form");
	errortext = document.querySelector("#error");
	
	form_obj.onsubmit = function() {
		un = document.querySelector("#un").value;
		pw = document.querySelector("#pw").value;

		if (un=="")
		{
			errortext.innerHTML = "Please enter a username or an email address.";
			return false;
		}
		else if (pw=="")
		{
			errortext.innerHTML = "Please enter a password.";
			return false;
		}

		return true;
	}

</script>

</div>

</body>
</html>
