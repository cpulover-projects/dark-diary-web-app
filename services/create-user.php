<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(isset($_SESSION['email'])){ //login with google
    $email = $_SESSION['email'];
    $password = "";
} else {
    $email = $_POST["email"];
//hash password
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
}


//create new user
$query = "INSERT INTO `user` (`email`, `password`) VALUES ('"
. mysqli_real_escape_string($link, $email)
. "','"
. mysqli_real_escape_string($link, $password)
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
    if(isset($_POST)){
    header("Location: main-page.php");
    }
} else {
    // echo "Could not sign up. Please try again";
}
?>