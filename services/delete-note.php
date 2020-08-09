<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include "connect-database.php";


if (isset($_POST)) {
    $query = "DELETE FROM note WHERE id=".$_POST["noteId"];
    mysqli_query($link,$query);
}

if ($_SESSION["currentNoteId"]==$_POST["noteId"]){
    $_SESSION["currentNoteId"] = false;
    echo true;
} else {
    echo false;
};
?>