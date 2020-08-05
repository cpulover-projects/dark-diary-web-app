<?php
session_start();
if(array_key_exists("id", $_COOKIE)){
    $_SESSION["id"]=$_COOKIE["id"];
}

if(array_key_exists("id",$_SESSION)){
    echo $_SESSION["id"];
    echo "<br>Logged in <br><a href='index.php?logout=1'>Log out</a>";
} else {
    header("Location: index.php");
}
?>