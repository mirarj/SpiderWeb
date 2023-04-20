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

<h1>Profile</h1>

	<?php
		session_start();
		//establish connection info
		$server = "35.212.65.183";
		$userid = "u0qw5mzxxutfs";
		$pw = "k1nwmps94r8z";
		$db = "dbg1zmcxmgjkkw";
		$conn = new mysqli($server, $userid, $pw, $db);

		// get data
		$curruser = $_SESSION['userid'];

		echo "<h2>THIS IS THE PROFILE PAGE FOR ".$curruser."<h2>";

		$sql = "SELECT * from users WHERE username='".$curruser."'";
		$result = $conn->query($sql);

		foreach ($result as $rowid=>$rowdata) {
			foreach ($rowdata as $field=>$value) {
				echo $field.": ".$value."<br/>";
			}
		}

		$conn->close();
	?>

</body>
</html>
