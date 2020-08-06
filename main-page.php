<?php

session_start();
include "process/connect-database.php";
if (isset($_COOKIE["id"])) {
    $_SESSION["id"] = $_COOKIE["id"];
    echo "Cookie set<br>";
}

if (isset($_SESSION["id"])) {
    // echo $_SESSION["id"];
    echo "<br><a href='index.php?logout=1'>Log out</a><br>";
} else {
    header("Location: index.php");
}

$userId = $_SESSION["id"];
$query = "SELECT * FROM note WHERE userId=" . $userId;
$result = mysqli_query($link, $query);

if ($result) {
    echo "<h3>Your notes</h3>";
    while ($row = mysqli_fetch_array($result)) {
        echo "Title: ".$row["title"]
            ."<br>Content: ".$row["content"]
            ."<br>Date: ".$row["date"]."<br><br>";
    }
} else {
    echo "There is no note";
}
?>