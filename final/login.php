<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SpiderWeb Movies - Log In</title>
<style>
</style>
<link rel='stylesheet' href='style.css'>
</head>

<body>

<!-- password for mjain02 is "mypassword" -->
<header>
	<a href="./index.php"><img src="./images/swico.ico"></a>
	<form method="get" id="searchbar" action="search.php">
		<label for="em">Search</label>
		<input type='text' name='query'>
		<input type = "submit" value = "icon" />
	</form>
	<h1>Login</h1>
	<?php
	session_start();
	if (isset($_POST['logout'])) {
		session_destroy();
		echo '<script type="text/javascript">window.location = "login.php"</script>'; // refresh page
	}
	if (isset($_SESSION['userid'])){
		echo "Logged in";
		echo "<form method='post' action='login.php' class='loginout'><input type='submit' name='logout' value='Log Out'></form>";
	}
	else{
		echo "Not logged in";
		echo "<form method='get' action='login.php' class='loginout'><input type='submit' value='Log In'></form>";
	}	
	?>
</header>

<form method="post" id="form1" onsubmit='login.php' action="login.php">
	<label for="un">Username/Email</label> <br />
	<input type='text' name='username' id='un'><br>
	<label for="pw">Password</label> <br />
	<input type='password' name='password' id='pw'><br>
	<input type = "submit" value = "Log In" />
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
						echo "success, redirect to profile page for ".$_SESSION['userid'];
						header('profile.php');
						echo '<script type="text/javascript">window.location = "profile.php"</script>';
					}
					else {
						echo "Incorrect password.";
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
						echo "success, redirect to profile page for ".$_SESSION['userid'];
						header('profile.php');
						echo '<script type="text/javascript">window.location = "profile.php"</script>';
					}
					else {
						echo "Incorrect password.";
					}

				}
			}
		}

		if (!$found) {
			echo "We don't have an account with this email address or username. Please <a href='./signup.php'>Create an account</a> here.";
		}

		$conn->close();
	
	}

?>

<script>

	form_obj = document.querySelector("#form1");

	form_obj.onsubmit = function() {
		
		// validate name is entered
		if (userinfo[0].value=='' || userinfo[1].value=='') {
			alert("Please enter your full name.");
			return false;
		}

		// validate some item ordered
		something_ordered = false;
		item_quants.forEach(e => {
			if (e.value != '0') {
				something_ordered = true;
			}
		});
		if (!something_ordered) {
			alert("Please order at least one item.");
			return false;
		}

		// validate time
		now = new Date();
		date.value = now.getTimezoneOffset();

		open = new Date();
		open.setHours(20,0,0,0);
		close = new Date();
		close.setHours(2,30,0,0);

		if (now>close && now<open) {
			alert("Sorry, we only accept orders between 8:00 PM and 2:30 AM.")
			return false;
		}

		return true;

	}

</script>

<a href='./signup.php'><p>Create Account</p></a>

</body>
</html>
