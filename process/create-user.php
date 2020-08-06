<?php

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
    if ($_POST["stayLoggedIn"] == "1") {
        setcookie("id", 1, time() + 60*60, "/");
    }
    header("Location: main-page.php");
} else {
    echo "Could not sign up. Please try again";
}
?>