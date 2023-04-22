<?php

function makeHeader($filename, $pagetitle) {
echo "<header>";
	// Home/search icon
	echo "<a href='./search.php'><img src='./images/swico.ico'></a>";
    // page title
	echo "<h1>$pagetitle</h1>";
	// Log in/out
	if (isset($_POST['logout'])) {
		session_destroy();
		echo "<script type='text/javascript'>window.location = '$filename'</script>"; // refresh page
	}
	if (isset($_SESSION['userid'])){
		echo "Logged in";
		echo "<form method='post' action='$filename' class='loginout'><input type='submit' name='logout' value='Log Out'></form>";
	}
	else{
		echo "Not logged in";
		echo "<form method='get' action='login.php' class='loginout'><input type='submit' value='Log In'></form>";
	}	
echo "</header>";
}
?>