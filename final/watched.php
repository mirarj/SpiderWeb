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
	//establish connection info
	$server = "35.212.42.21";
	$userid = "uaqtg5oezskik";
	$pw = "talissqluser";
	$db = "db4qzjfvgwun4s";
	$conn = new mysqli($server, $userid, $pw, $db);
			
	if (isset($_SESSION['userid'])){
		$curruser = $_SESSION['userid'];
		// $sql = "SELECT MovieId from Watched WHERE UserId='".$curruser."'";
		$sql = "SELECT MovieId from Watched WHERE UserId='tali'";
		$q = $conn->query($sql);

		foreach ($q as $rowid=>$rowdata) {
			foreach ($rowdata as $key=>$value) {
				$ids[$rowid] = $value;
			}
		}
		foreach ($ids as $id) {
			echo $id."<br>";
		}

		$idsarr = json_encode($ids);

		echo "<script>";
			echo "arr = JSON.parse('".$idsarr."');";
			echo 'console.log(arr);';
		echo "</script>";


		echo "Logged in<br>";
		echo "<form method='post' action='watched.php'><input type='submit' name='logout' value='Log Out'></form>";
	}
	else{
		echo "<p class='unavailable'>This page is only available to logged in users. Please <a href='./login.php'>Log In</a> here.</p>";
	}	
	?>

</body>
</html>
