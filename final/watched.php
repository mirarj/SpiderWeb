<?php
session_start();
?>
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
	if (isset($_SESSION['userid'])){
		$sql = "SELECT * from watched WHERE";
		echo "Logged in<br>";
		echo "<form method='post' action='watched.php'><input type='submit' name='logout' value='Log Out'></form>";
		echo "DISPLAY LIST";
	}
	else{
		echo "<p class='unavailable'>This page is only available to logged in users. Please <a href='./login.php'>Log In</a> here.</p>";
	}	
	?>

</body>
</html>
