
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

$maxTitleLetters = 15;
$maxContentLetters = 400;

if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        if (strlen($row["title"]) > $maxTitleLetters) {
            $titleSummary = substr($row["title"], 0, $maxTitleLetters) . "...";
        } else {
            $titleSummary = $row["title"];
        }

        if (strlen($row["content"]) > $maxContentLetters) {
            $contentSummary = substr($row["content"], 0, $maxContentLetters) . "...";
        } else {
            $contentSummary = $row["content"];
        }

        $selectState =" ";
        if ($row["id"] == $_SESSION["currentNoteId"]) {
            $selectState = " selected";}

         echo
            '<div class="list-group-item bg-light note'.$selectState.'" id=' . $row["id"] .
            ' data-toggle="popover" data-trigger="hover"
         title="' . $row["title"] . '"
         data-content="' . $contentSummary . '">
          <b>' . $titleSummary . '</b> <br>
          <i>' . $row["date"] . '</i>

          <div class="hidden" id="fullTitle">' . $row["title"] . '</div>
          <div class="hidden" id="fullContent">' . $row["content"] . '</div>
          <button class="btn btn-danger delete">Delete</button>
        </div>';
    }
}
?>

