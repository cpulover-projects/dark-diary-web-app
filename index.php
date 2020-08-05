<?php
include "properties.php";
$link = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_error()) {
    die("Failed to connect to database<br>");
} else {
    echo "Connect to database successfully<br>";
}

