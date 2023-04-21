<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>SpiderWeb Movies - Sign Up</title>
<style>
</style>
<link rel='stylesheet' href='style.css'>
</head>

<body>

<header>
	<!-- Home icon -->
	<a href="./index.php"><img src="./images/swico.ico"></a>
	<!-- Search bar -->
	<form method="get" id="searchbar" action="search.php">
		<label for="em">Search</label>
		<input type='text' name='query'>
		<input type = "submit" value = "icon" />
	</form>
	<!-- page h1 -->
	<h1>SpiderWebMovies</h1>
	<?php
	// Log in/out
	session_start();
	if (isset($_POST['logout'])) {
		session_destroy();
		echo '<script type="text/javascript">window.location = "index.php"</script>'; // refresh page
	}
	if (isset($_SESSION['userid'])){
		echo "Logged in";
		echo "<form method='post' action='index.php' class='loginout'><input type='submit' name='logout' value='Log Out'></form>";
	}
	else{
		echo "Not logged in";
		echo "<form method='get' action='login.php' class='loginout'><input type='submit' value='Log In'></form>";
	}	
	?>
</header>

<a href='./profile.php'>Go to my profile</a>

</body>
</html>
