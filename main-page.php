<?php

if (!isset($_SESSION)) {
    session_start();
}

include "services/connect-database.php";
if (isset($_COOKIE["id"])) {
    $_SESSION["id"] = $_COOKIE["id"];
    $userId = $_SESSION["id"];
    // echo "Cookie set<br>";
} else {
  $userId= false;
}

if (!isset($_SESSION["id"]) && isset($_SESSION['access_token']) && $_SESSION['access_token'] == '') {
    header("Location: index.php");
} else {

}

?>

<?php

//Include Google Configuration File
include 'google-config.php';

// if (isset($_SESSION['access_token']) && $_SESSION['access_token'] == '') {
//     // echo "No token";
//     header("Location: index.php");
// } else {
//     // echo "Token: " . $_SESSION['access_token']."<br>";
// }

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if (isset($_GET["code"])) {
    // echo "Code: " . $_GET["code"];
    //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    
    // echo "Token: " . $_SESSION['access_token'];



    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if (!isset($token['error'])) {
        // echo "No error";
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);

        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];

        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);

        //Get user profile data from google
        $data = $google_service->userinfo->get();

        //Below you can find Get profile data and store into $_SESSION variable
        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['email'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    } 
} 

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

