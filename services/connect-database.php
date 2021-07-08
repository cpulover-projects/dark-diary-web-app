<?php
$propertyFile = 'properties.php';

if (file_exists($propertyFile)) {
        include $propertyFile;
}

$link = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_error()) {
        // echo $_SERVER['DOCUMENT_ROOT'];
        die("Failed to connect to databasefrom base service<br>");
} else {
        // echo "Connect to database successfully<br>";
}
