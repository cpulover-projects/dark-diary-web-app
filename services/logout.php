<?php

// destroy cookie and session when logout
if (isset($_GET["logout"])) {

    if (isset($_SESSION["id"])) {
        unset($_SESSION["id"]);
        setcookie("id", 0, time() - 1000, "/");

    }
    $_SESSION["currentNoteId"] = false;

    $googleConfig = "/home3/cpulover/public_html/projects/the-dark-diary/google-config.php";
    if (file_exists($googleConfig)) {
        include $googleConfig;
    }
    //Reset OAuth access token
    // echo "Reseting OAuth...";
    // $google_client->revokeToken();
    if (isset($_SESSION['access_token'])) {
        $google_client->revokeToken($_SESSION['access_token']);
    }
    //Destroy entire session data.
    session_destroy();
    //redirect page to index.php
    header('Location: index.php');

} elseif (isset($_SESSION["id"]) or isset($_COOKIE["id"])) {
    header("Location: main-page.php");
}
;

// if (headers_sent()) {
//     trigger_error("Cant change cookies", E_USER_NOTICE);
//   }
