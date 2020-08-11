<?php

$property1 = "/home/sites/11a/2/2148d4b421/public_html/the-dark-diary/properties.php";
$property2 = "/home3/cpulover/public_html/projects/the-dark-diary/properties.php";

if(file_exists($property1)){
    include $property1;
}

if(file_exists($property2)){
    include $property2;
}
// include "/home/sites/11a/2/2148d4b421/public_html/the-dark-diary/properties.php"; //import database properties from secured file
// include "/home3/cpulover/public_html/projects/the-dark-diary/properties.php"; //import database properties from secured file
$link = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_error()) {
    // echo $_SERVER['DOCUMENT_ROOT'];
    die("Failed to connect to databasefrom base service<br>");
} else {
    // echo "Connect to database successfully<br>";
}
?>