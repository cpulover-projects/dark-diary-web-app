<?php

if (!isset($_SESSION)) {
        session_start();
}

include "services/connect-database.php";

if (isset($_SESSION["email"])) {
        $emailExisted = false;

        $query = "SELECT * FROM `user`";
        $result = mysqli_query($link, $query);
        if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                        if ($row["email"] == $_SESSION["email"]) {
                                $_SESSION['id'] = $row['id'];
                                $userId = $_SESSION["id"];
                                $emailExisted = true;
                                break;
                        }
                }
        }

        if (!$emailExisted) {
                include "services/create-user.php";
        }
}
