<?php

session_start();
include "process/connect-database.php";
if (isset($_COOKIE["id"])) {
    $_SESSION["id"] = $_COOKIE["id"];
    echo "Cookie set<br>";
}

if (isset($_SESSION["id"])) {
    // echo $_SESSION["id"];
    echo "<h3><a href='index.php?logout=1'>Log out</a></h3><br>";
} else {
    header("Location: index.php");
}

$userId = $_SESSION["id"];

?>

<!-- Create note -->
<form method="post">
    <input type="text" name="title" id="title">
    <input type="text" name="content" id="content">
    <input type="date" name="date" id="date">
    <input type="submit" name="submit" value="Add new note">
</form>

<?php
if (isset($_POST["submit"])) {
    $newTitle = mysqli_real_escape_string($link, $_POST["title"]);
    $newContent = mysqli_real_escape_string($link, $_POST["content"]);
    $newDate = mysqli_real_escape_string($link, $_POST["date"]);

    $query = "INSERT INTO note (`title`, `content`, `date`, `userId`) VALUES ('"
        . $newTitle . "','"
        . $newContent . "','"
        . $newDate . "','"
        . $userId . "')";
    mysqli_query($link,$query);
}
?>

<?php
// View notes
$query = "SELECT * FROM note WHERE userId=" . $userId;
$result = mysqli_query($link, $query);

if ($result) {
    echo "<h3>Your notes</h3>";
    while ($row = mysqli_fetch_array($result)) {
        echo "Title: " . $row["title"]
            . "<br>Content: " . $row["content"]
            . "<br>Date: " . $row["date"] . "<br><br>";
    }
} else {
    echo "There is no note";
}
?>