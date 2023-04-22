<?php

function makeHeader($filename, $pagetitle) {
echo "<header>";
    echo '<div id="search_button">';
            echo '<a id="search_btn" href="search.php"><i class="fa-solid fa-magnifying-glass" style="color: #001B2E;"></i></a>';
    echo '</div>';
	echo '<h1>'.$pagetitle.'</h1>';
    echo '<div id="drowdown">';
        echo '<button id="user" class="user"  onclick="activate_dropdown()"><i class="fa-solid fa-user" style="color: #001B2E;"></i></button>';
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
				echo "<form method='post' action='$filename' class='loginout'><input type='submit' name='logout' value='Log Out'></form>";
			}
			else{
				echo "<form method='get' action='login.php' class='loginout'><input type='submit' value='Log In'></form>";
			}
		echo "</div>";
	echo "</div>";
echo "</header>";
}
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
