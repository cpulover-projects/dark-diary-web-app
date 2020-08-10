<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

include "services/connect-database.php";
if (isset($_COOKIE["id"])) {
    $_SESSION["id"] = $_COOKIE["id"];
    // echo "Cookie set<br>";
}

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
}

$userId = $_SESSION["id"];

?>

<?php include "sections/head.php";?>

<!-- TODO: include external css not working -->
<style>
  html {
    background: none;
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
      <?php include "services/load-sidebar-note.php"?>
    </div>
  </div>
  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->
  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
      <button class="btn btn-light mr-2" id="menu-toggle">My notes</button>
      <button class="btn btn-light" id="addNote">New note</button>

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

    <script src="resources/js/script.js"></script>

    <div class="container-fluid">
      <!-- LOAD FORM -->
      <?php include "services/load-form.php";?>

    </div>

  </div>
  <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "sections/script-entries.php";?>

