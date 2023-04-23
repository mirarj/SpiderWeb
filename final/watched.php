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
	<?php
	//establish connection info
	$server = "35.212.42.21";
	$userid = "uaqtg5oezskik";
	$pw = "talissqluser";
	$db = "db4qzjfvgwun4s";
	$conn = new mysqli($server, $userid, $pw, $db);
			
	if (isset($_SESSION['userid'])){
		$curruser = $_SESSION['userid'];
		// $sql = "SELECT MovieId from Watched WHERE UserId='".$curruser."'";
		$sql = "SELECT MovieId from Watched WHERE UserId='".$curruser."'";
		$q = $conn->query($sql);

		foreach ($q as $rowid=>$rowdata) {
			foreach ($rowdata as $key=>$value) {
				$ids[$rowid] = $value;
			}
		}
		$idsarr = json_encode($ids);

		echo "<script>";
			echo "arr = JSON.parse('".$idsarr."');";
		echo "</script>";
	}
	else{
		echo "<p class='unavailable'>This page is only available to logged in users. Please <a href='./login.php'>Log In</a> here.</p>";
	}	
	?>
	<script>
		// display here
		document.write(JSON.stringify(arr))
		console.log(arr);
	</script>

</body>
</html>
