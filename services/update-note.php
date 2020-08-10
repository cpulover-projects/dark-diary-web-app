<?php

if (!isset($_SESSION)) {
    session_start();
}
include "connect-database.php";

if (isset($_POST)) {
    $title = mysqli_real_escape_string($link, $_POST["title"]);
    $date = mysqli_real_escape_string($link, $_POST["date"]);
    $content = mysqli_real_escape_string($link, $_POST["content"]);
    $userId = $_SESSION["id"];

    // echo $title.$date.$content;

    if ($_POST["selectedNoteId"]) {
        $_SESSION["currentNoteId"] = $_POST["selectedNoteId"];
        exit('');
    }

    // echo "currentId: ".$_SESSION["currentNoteId"]." selectedId: ".$_POST["selectedNoteId"];
    if (!$_SESSION["currentNoteId"]) {
        // echo ">>> Inserting...";
        $insertQuery = "INSERT INTO note (`title`, `content`, `date`, `userId`) VALUES ('"
            . $title . "','"
            . $content . "','"
            . $date . "','"
            . $userId . "')";

        if (mysqli_query($link, $insertQuery)) {
            // echo "Insert uccessfully";
            $_SESSION["currentNoteId"] = mysqli_insert_id($link);
        } else {
            echo "Failed to insert";
        }
        ;
    } else {
        // echo ">>> Updating...";
        $updateQuery = "UPDATE note SET `title` ='" . $title
            . "', `content` ='" . $content
            . "', `date` ='" . $date
            . "' WHERE id =" . $_SESSION["currentNoteId"];
        if (mysqli_query($link, $updateQuery)) {
            // echo "Update successfully";
        } else {
            echo "Failed to update";
        }
        ;
    }
}
