
<?php

session_start();
$userId = $_SESSION["id"];
//TODO: why $link from include not working???
// include "./connect-database.php";

//manually connect to database instead
include "../properties.php"; //import database properties from secured file
$link = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_error()) {
    die("Failed to connect to database<br>");
} else {
    // echo "Connect to database successfully<br>";
}

$query = "SELECT * FROM note WHERE userId=" . $userId
    . " AND `title` LIKE '%" . $_POST["searchKeyword"] . "%'";

$result = mysqli_query($link, $query);

if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        echo
            '<div class="list-group-item bg-light note" id=' . $row["id"] .
            ' data-toggle="popover" data-trigger="hover"
            title="' . $row["title"] . '"
            data-content="' . $row["content"] . '">
              <b>' . $row["title"] . '</b> <br>
              <i>' . $row["date"] . '</i>
              <button class="btn btn-danger delete">Delete</button>
            </div>';
    }
}
?>

