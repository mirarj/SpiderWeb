<?php
    $server = "localhost";
    $userid = "uaqtg5oezskik";
    $pw = "talissqluser";
    $db = "db4qzjfvgwun4s";

    

    $conn = new mysqli($server, $userid, $pw);

    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->select_db($db);
    

    $user_id = $_POST["userid"];
    $movie_id = $_POST["movieid"];

   

    $sql = "DELETE FROM `WatchLater` WHERE MovieId = $movie_id and UserId = '$user_id'";
    
    $result = $conn->query($sql);

    mysqli_close($conn);
    


?>