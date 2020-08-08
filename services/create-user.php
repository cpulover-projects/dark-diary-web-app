<?php

session_start();
//hash password
$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

//create new user
$query = "INSERT INTO `user` (`email`, `password`) VALUES ('"
. mysqli_real_escape_string($link, $_POST["email"])
. "','"
. mysqli_real_escape_string($link, $hash)
    . "')";

if (mysqli_query($link, $query)) {
    $_SESSION["id"] = mysqli_insert_id($link);
    if ($_POST["stayLoggedIn"]) {
        setcookie("id", $_SESSION["id"], time() + 60*60*24*30, "/");
        echo($_SESSION["id"]);
        echo "<h1> cookie set: ".$_COOKIE["id"]."</h1>";
    } else {
        echo "<h1> cookie not set: ".$_COOKIE["id"]."</h1>";
    }
    header("Location: main-page.php");
} else {
    echo "Could not sign up. Please try again";
}
?>