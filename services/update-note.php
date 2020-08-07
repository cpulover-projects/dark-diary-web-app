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
    $title = mysqli_real_escape_string($link, $_POST["title"]);
    $date = mysqli_real_escape_string($link, $_POST["date"]);
    $content = mysqli_real_escape_string($link, $_POST["content"]);
    $userId = $_SESSION["id"];

    echo $title.$date.$content;

    if (!$_SESSION["currentNoteId"]) {
        $insertQuery = "INSERT INTO note (`title`, `content`, `date`, `userId`) VALUES ('"
            . $title . "','"
            . $content . "','"
            . $date . "','"
            . $userId . "')";

        if (mysqli_query($link, $insertQuery)) {
            echo "Insert uccessfully";
            $_SESSION["currentNoteId"] = mysqli_insert_id($link);
        } else {
            echo "Failed to insert";
        }
        ;
    } else {
        echo $_SESSION["currentNoteId"];
        $updateQuery = "UPDATE note SET `title` ='".$title
                        ."', `content` ='".$content
                        ."', `date` ='".$date
                        ."' WHERE id =".$_SESSION["currentNoteId"];
        if(mysqli_query($link, $updateQuery)){
            echo "Update successfully";
        } else{
            echo "Failed to update";
        };
    }
}
