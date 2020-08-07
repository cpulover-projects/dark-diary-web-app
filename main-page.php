<?php

session_start();
include "services/connect-database.php";
if (isset($_COOKIE["id"])) {
    $_SESSION["id"] = $_COOKIE["id"];
    echo "Cookie set<br>";
}

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    // echo "<h3><a href='index.php?logout=1'>Log out</a></h3><br>";
}

$userId = $_SESSION["id"];

?>

<?php
if (isset($_POST["addNote"])) {
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

<?php include "sections/head.php";?>
<style>
  html {
    background: none;
  }

  .form-control {
  border: 0 !important;
  /* border-bottom: gray 1px solid !important; */
  border-radius: 0;
  /* background-color: rgb(215, 215, 215) !important; */
  background-color: white !important;
}
#title {
  font-size: 25px;
  font-weight: bold;
}
.form-group {
  margin-top: 5px;
}
</style>


<div class="d-flex" id="wrapper">

  <!-- Sidebar -->
  <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">
      <input type="search" name="search" id="search" placeholder="Search note">
    </div>
    <div class="list-group list-group-flush">
      <!-- list-group-item-action -->

      <?php
$query = "SELECT * FROM note WHERE userId=" . $userId;
$result = mysqli_query($link, $query);

if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        echo
            '<div class="list-group-item bg-light" data-toggle="popover" data-trigger="hover" 
            title="'.$row["title"].'" 
            data-content="'.$row["content"].'">
              <b>' . $row["title"] . '</b> <br>
              <i>' . $row["date"] . '</i>
            </div>';
    }
}
?>

    </div>
  </div>
  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->
  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
      <button class="btn btn-danger" id="menu-toggle">My notes</button>

      <!-- ??? -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php?logout=1">Log out</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <!-- Create note -->
      <form method="post">
        <div class="form-group">
          <input type="text" name="title" id="title" class="form-control bg-light" placeholder="Title">
          <hr>
          <input type="date" name="date" id="date" class="form-control bg-light">
          <hr>
          <textarea name="content" id="content" rows="16" placeholder="Content" class="form-control bg-light"></textarea>
        </div>
        
        <button type="submit" name="addNote" class="btn btn-dark">Save</button>
      </form>

    </div>

  </div>
  <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->


<?php include "sections/script-entries.php";?>