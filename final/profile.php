<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SpiderWeb Movies - My Profile</title>
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
	<h1>Profile</h1>
	<?php
	session_start();
	if (isset($_POST['logout'])) {
		session_destroy();
		echo '<script type="text/javascript">window.location = "profile.php"</script>'; // refresh page
	}
	if (isset($_SESSION['userid'])){
		echo "Logged in";
		echo "<form method='post' action='profile.php' class='loginout'><input type='submit' name='logout' value='Log Out'></form>";
	}
	else{
		echo "Not logged in";
		echo "<form method='get' action='login.php' class='loginout'><input type='submit' value='Log In'></form>";
	}	
	?>
</header>


<a href='./watched.php'><p>Watched</p></a>
<a href='./wishlist.php'><p>Wishlist</p></a>

<?php
	if (isset($_SESSION['userid'])) {
		//establish connection info
		$server = "35.212.42.21";
		$userid = "uaqtg5oezskik";
		$pw = "talissqluser";
		$db = "db4qzjfvgwun4s";
		$conn = new mysqli($server, $userid, $pw, $db);

		$curruser = $_SESSION['userid'];

		echo "<h2>THIS IS THE PROFILE PAGE FOR ".$curruser."<h2>";

		$sql = "SELECT * from users WHERE username='".$curruser."'";
		$result = $conn->query($sql);

		function disp_query($q)
		{
			echo "<table><tr>";
			$fields = $q->fetch_fields();
			foreach ($fields as $f) {
				echo "<th>".$f->name."</th>";
			}
			echo "</tr>";
			foreach ($q as $rowid=>$rowdata) {
				echo "<tr>";
				foreach ($rowdata as $key=>$value) {
					echo "<td>$value</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		}

		disp_query($result);

		$conn->close();
	}
	else {
		echo "not logged in";
	}

?>

</body>
</html>
