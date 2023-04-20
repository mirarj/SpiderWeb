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
$server = "35.212.65.183"; //<<<<<<<<<=======THIS
$userid = "uaqtg5oezskik";
$pw = "talissqluser";
$db = "db4qzjfvgwun4s";

$conn = new mysqli($server, $userid, $pw, $db);

$tables = $conn->query("SHOW TABLES");
echo $tables;
foreach ($result as $t) {
	echo "<h2>$t</h2>";
	// $table = $conn->query("SELECT * FROM $t");
	// foreach ($table as $rowid=>$rowdata) {
	// 	echo $rowid."<br>";
	// 	foreach ($rowdata as $key=>$value) {
	// 		echo "$key: $value<br>";
	// 	}
	// }
}

// $sql = "CREATE TABLE users (`id` INT(20) PRIMARY KEY AUTO_INCREMENT, `username` VARCHAR(255) UNIQUE, `email` VARCHAR(255) UNIQUE, `password` VARCHAR(255));";

?>
	


</body>
</html>
