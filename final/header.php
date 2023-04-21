<?php

function makeHeader($filename, $pagetitle) {
echo "<header>";
	// Home icon
	echo "<a href='./index.php'><img src='./images/swico.ico'></a>";
    // Search bar
    echo "<form method='get' id='searchbar' action='search.php'>";
        echo "<label for='em'>Search</label>";
        echo "<input type='text' name='query'>";
        echo "<input type = 'submit' value = 'icon'>";
    echo "</form>";
    // page title
	echo "<h1>$pagetitle</h1>";
	// Log in/out
	session_start();
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