<?php

// destroy cookie and session when logout
if (isset($_GET["logout"])) {
    unset($_SESSION["id"]);
    setcookie("id", "", -1);
    echo $_SESSION["id"] . $_COOKIE["id"];
    $_COOKIE["id"] = "";
} elseif ($_SESSION["id"] or $_COOKIE["id"]) {
    header("Location: main-page.php");
}
?>