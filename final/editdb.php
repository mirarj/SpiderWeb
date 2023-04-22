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

<h1>Testing</h1>

<?php
//establish connection info
$server = "35.212.42.21";
$userid = "uaqtg5oezskik";
$pw = "talissqluser";
$db = "db4qzjfvgwun4s";

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

$conn = new mysqli($server, $userid, $pw, $db);

$tables = $conn->query("SHOW TABLES");
foreach ($tables as $table) {
	foreach ($table as $key=>$tname){
		echo "<h2>".$tname."</h2>";
		$d = $conn->query("DESCRIBE $tname");
		disp_query($d);
		$t = $conn->query("SELECT * FROM $tname");
		disp_query($t);
		
	}
}

// $sql = "CREATE TABLE users (`id` INT(20) PRIMARY KEY AUTO_INCREMENT, `username` VARCHAR(255) UNIQUE, `email` VARCHAR(255) UNIQUE, `password` VARCHAR(255));";
// $sql = "ALTER TABLE WatchLater ADD `id` INT(20) PRIMARY KEY AUTO_INCREMENT FIRST";
// $sql = "ALTER TABLE Watched ADD `id` INT(20) PRIMARY KEY AUTO_INCREMENT FIRST";
// consistent dtype sizes
// rename move to movie
// drop empty user

// $x = $conn->query($sql);
// disp_query($x);

?>
	


</body>
</html>
