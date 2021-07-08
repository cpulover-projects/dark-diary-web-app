<?php

if (!isset($_SESSION)) {
        session_start();
}

if (isset($_POST["selectedNoteId"])) {
        $_SESSION["currentNoteId"] = $_POST["selectedNoteId"];
        // echo ">>> Select note: ".$_POST["selectedNoteId"];
        exit('');
};

include "connect-database.php";

if (isset($_POST)) {
        $title = mysqli_real_escape_string($link, $_POST["title"]);
        $date = mysqli_real_escape_string($link, $_POST["date"]);
        $content = mysqli_real_escape_string($link, $_POST["content"]);
        $userId = $_SESSION["id"];

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
                };
        } else {
                echo $_SESSION["currentNoteId"];
                $updateQuery = "UPDATE note SET `title` ='" . $title
                        . "', `content` ='" . $content
                        . "', `date` ='" . $date
                        . "' WHERE id =" . $_SESSION["currentNoteId"];
                if (mysqli_query($link, $updateQuery)) {
                        // echo "<br>Update successfully";
                        // echo "<br>Content: ".$content;
                } else {
                        echo "Failed to update";
                };
        }
}
