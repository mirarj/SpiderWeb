<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SpiderWeb Movies - Watched List</title>
<style>
</style>
<link rel='stylesheet' href='style.css'>
</head>

<body>

<?php
	include('./header.php');
	makeHeader('watched.php', 'My Watched List');
?>

<h1>My Watched List</h1>

	<?php
	session_start();
	if (isset($_POST['logout'])) {
		session_destroy();
	}
	if (isset($_SESSION['userid'])){
		echo "Logged in<br>";
		echo "<form method='post' action='watched.php'><input type='submit' name='logout' value='Log Out'></form>";
		echo "DISPLAY LIST";
	}
	else{
		echo "Not logged in<br>";
		echo "<form method='get' action='login.php'><input type='submit' value='Log In'></form>";
		echo "<a href='./login.php'><p>Login</p></a>";
	}	
	?>

</body>
</html>
