<style>
header {
	border-bottom: 2px solid #001B2E;
	display: flex;
	justify-content: space-between;
}	

header h1 {
	display: block;
	text-align: center;
	border: 15px;
	border-radius: 30px;
	margin: 10px auto;
	padding-top: 10px;
	padding-bottom: 10px;
	font-size: 2em;
	font-weight: bold;
	color: #FFF8F0;
	background-color:#e84855;
	width: 40%;
	min-width: 300px;
	float: center;
	max-height: 1em;
}

#search_button {
	display: inline-block;
	width: 20%;
	text-align: right;
}

#search_btn {
	display: inline-flex;
	justify-content: right;
	width: min-content;
	padding: 16px;
	font-size: 16px;
	border: none;
	cursor: pointer;
	background-color: #00000000;
	text-decoration: none;
}

#dropdown {
	display: inline-block;
	width: 20%;
	text-align: left;
}

#user {
	display: inline-flex;
	justify-content: space-between;
	padding: 16px;
	font-size: 16px;
	border: none;
	cursor: pointer;
	background-color: #00000000;
}

#user .username {
	color: #001B2E;
	display: inline-block;
	margin-left: 0.5em;
}

.cnt {
	display: none;
	position: absolute;
	background-color: #f1f1f1;
	min-width: 160px;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	z-index: 1;
	text-align: center;
}

.cnt a, #log {
	color: black;
	padding: 20px 20px;
	text-decoration: none;
	display: block;
	font-size: large;
}

.cnt a:hover, #log:hover {
	background-color: #ddd;
	font-weight: bolder;
}

#log {
	margin: 0 auto;
	padding: 15px 20px;
	border: none;
	width: 100%;
	cursor: pointer;
}

.show {
	display:block;
}

</style>
<?php

function makeHeader($filename, $pagetitle) {
echo "<header>";
    echo '<div id="dropdown">';
		if (isset($_SESSION['userid'])){
			echo '<button id="user" class="user"  onclick="activate_dropdown()"><i class="fa-solid fa-user" style="color: #001B2E;"></i><div class="username">'.$_SESSION['userid'].'</div></button>';
		}
		else {
			echo '<button id="user" class="user"  onclick="activate_dropdown()"><i class="fa-solid fa-user" style="color: #001B2E;"></i></button>';
		}
        echo '<div id="content" class="cnt">';
            echo '<a href="watched.php">My Watch List</a>';
            echo '<a href="wishlist.php">My Wishlist</a>';
            echo '<a href="rec.php">My Recommendations</a>';
            echo '<a href="connect.php">Connect with Others</a>';
			if (isset($_POST['logout'])) {
				session_destroy();
				echo "<script type='text/javascript'>window.location = '$filename'</script>"; // refresh page
			}
			if (isset($_SESSION['userid'])){
				echo "<form method='post' action='$filename' class='loginout'><input type='submit' id='log' name='logout' value='Log Out'></form>";
			}
			else{
				echo "<form method='get' action='login.php' class='loginout'><input type='submit' id='log' value='Log In'></form>";
			}
		echo "</div>";
	echo "</div>";
	echo '<h1>'.$pagetitle.'</h1>';
	echo '<div id="search_button">';
	echo '<a id="search_btn" href="search.php"><i class="fa-solid fa-magnifying-glass" style="color: #001B2E;"></i></a>';
	echo '</div>';
echo "</header>";
echo '<script src="https://kit.fontawesome.com/a7de828ebd.js" crossorigin="anonymous"></script>';
echo '<script>'
		.'function activate_dropdown() {'
			.'console.log("activated");'
			.'document.getElementById("content").classList.toggle("show");'
		.'}'

		.'// Close the dropdown menu if the user clicks outside of it'
		.'window.onclick = function(event) {'
			.'if (!event.target.matches(".user")) {'
				.'var dropdowns = document.getElementsByClassName("cnt");'
				.'var i;'
				.'for (i = 0; i < dropdowns.length; i++) {'
					.'var openDropdown = dropdowns[i];'
					.'if (openDropdown.classList.contains("show")) {'
						.'openDropdown.classList.remove("show");'
					.'}'
				.'}'
			.'}'
		.'}'
.'</script>';
}
?>
