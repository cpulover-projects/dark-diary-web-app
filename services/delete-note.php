<?php

session_start();
//TODO: why $link from include not working???
// include "./connect-database.php";

//manually connect to database instead
include "../properties.php"; //import database properties from secured file
$link = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_error()) {
    die("Failed to connect to database<br>");
} else {
    // echo "Connect to database successfully<br>";
}

if (isset($_POST)) {
    $query = "DELETE FROM note WHERE id=".$_POST["noteId"];
    mysqli_query($link,$query);
}
?>