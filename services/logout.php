<?php

// destroy cookie and session when logout
if (isset($_GET["logout"])) {
    if (isset($_SESSION["id"])) {
        unset($_SESSION["id"]);
        setcookie("id", "", -1);
        // echo $_SESSION["id"] . $_COOKIE["id"];
        $_COOKIE["id"] = "";
    }
} elseif (isset($_SESSION["id"]) or isset($_COOKIE["id"])) {
    header("Location: main-page.php");
}
