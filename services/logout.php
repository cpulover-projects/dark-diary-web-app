<?php

// destroy cookie and session when logout
if (isset($_GET["logout"])) {
    if (isset($_SESSION["id"])) {
        unset($_SESSION["id"]);
        setcookie("id", 0,  time()-1000,"/");
    }
    $_SESSION["currentNoteId"]=false;
} elseif (isset($_SESSION["id"]) or isset($_COOKIE["id"])) {
    header("Location: main-page.php");
};

// if (headers_sent()) {
//     trigger_error("Cant change cookies", E_USER_NOTICE);
//   }

