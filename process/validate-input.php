<?php

if (isset($_POST["submit"])) {
    $error = "";
    if (!$_POST["email"]) {
        $error .= "Email is required";
    }
    if (!$_POST["password"]) {
        $error .= "Password is required";
    } elseif ($_POST["signUp"] and !$_POST["passwordConfirm"]) {
        $error .= "Please comfirm password";
    } elseif ($_POST["signUp"] and $_POST["password"] != $_POST["passwordConfirm"]) {
        $error .= "Password does not match";
    }

    if ($error) {
        echo $error;
    } else {
        if ($_POST["signUp"]) {
            //authenticate the sign-up email not been registerd yet
            $emailExisted = false;
            $query = "SELECT `email` FROM `user`";
            if ($result = mysqli_query($link, $query)) {
                while ($row = mysqli_fetch_array($result)) {
                    if ($row["email"] == $_POST["email"]) {
                        $emailExisted = true;
                    }
                }
            }

            if ($emailExisted) {
                $error .= "This email is already registered";
                echo $error;
            } else {
                include "process/create-user.php";
            }
        } else {
            //authenticate sign in account from database
        }
    }
}
