<?php 

session_start();
include "../properties.php"; //import database properties from secured file
$link = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_error()) {
    die("Failed to connect to database<br>");
} else {
    // echo "Connect to database successfully<br>";
}


if ($_SESSION["currentNoteId"]) {
    $query = "SELECT * FROM note WHERE id=" . $_SESSION["currentNoteId"];
    $currentNote = mysqli_fetch_array(mysqli_query($link, $query));
} else {
    $currentNote = null;
}
?>

 <form method="post">
 <div class="form-group">
   <input type="text" name="title" id="title" class="form-control bg-light" placeholder="Title"
     value="<?php echo $currentNote["title"] ?>">
   <hr>
   <input type="date" name="date" id="date" class="form-control bg-light" 
   value="<?php echo $currentNote['date'];?>">
   <hr>
   <textarea name="content" id="content" rows="16" placeholder="Content"
     class="form-control bg-light"><?php echo $currentNote["content"] ?></textarea>
 </div>
</form>
