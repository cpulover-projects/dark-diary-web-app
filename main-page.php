<?php
session_start();
if(isset($_COOKIE["id"])){
    $_SESSION["id"]=$_COOKIE["id"];
    echo "Cookie set<br>";
}

if(isset($_SESSION["id"])){
    echo $_SESSION["id"];
    echo "<br>Logged in <br><a href='index.php?logout=1'>Log out</a>";
} else {
    header("Location: index.php");
}
?>