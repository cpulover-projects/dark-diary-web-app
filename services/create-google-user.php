<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
//hash password
$hash = password_hash("google", PASSWORD_DEFAULT);

if(isset($_SESSION["email"])){
echo "Gmail: ".$_SESSION["email"];
//create new user
$query = "INSERT INTO `user` (`email`, `password`) VALUES ('"
. mysqli_real_escape_string($link, $_SESSION["email"])
. "','"
. mysqli_real_escape_string($link, $hash)
    . "')";

if (mysqli_query($link, $query)) { 
    if (isset($_POST["stayLoggedIn1"])) {
        setcookie("id", mysqli_insert_id($link), time() + 60*60*24*30, "/");
        // echo($_SESSION["id"]);
        // echo "<h1> cookie set: ".$_COOKIE["id"]."</h1>";
    } else {
        // echo "<h1> cookie not set: ".$_COOKIE["id"]."</h1>";
    }
    $_SESSION["id"] = mysqli_insert_id($link);
    header("Location: main-page.php");
} else {
    // echo "Could not sign up. Please try again";
}
}

?>