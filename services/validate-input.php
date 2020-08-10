<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST["submit"])) {
    $error = "";

    //validate from input fields
    if (!$_POST["email"]) {
        $error .= "Email is required";
    }
    if (!$_POST["password"]) {
        $error .= "Password is required";
    } elseif (isset($_POST["signUp"]) and !$_POST["passwordConfirm"]) {
        $error .= "Please comfirm password";
    } elseif (isset($_POST["signUp"]) and $_POST["password"] != $_POST["passwordConfirm"]) {
        $error .= "Password does not match";
    }

    if ($error) {
        // echo $error;
    }
    //validate from database data
    else {
        $query = "SELECT * FROM `user`";
        $result = mysqli_query($link, $query);
        if (isset($_POST["signUp"])) {
            //authenticate the sign-up email not been registerd yet
            $emailExisted = false;

            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    if ($row["email"] == $_POST["email"]) {
                        $emailExisted = true;
                        break;
                    }
                }
            }

            if ($emailExisted) {
                $error .= "This email is already registered";
                // echo $error;
            } else {
                include "services/create-user.php";
            }
        } else {
            //authenticate sign in account from database
            $accountFound = false;
            $accountId = "";
            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    if ($row["email"] == $_POST["email"] and password_verify($_POST["password"], $row["password"])) {
                        $accountFound = true;
                        $accountId = $row["id"];
                        break;
                    }
                }
            }

            if (!$accountFound) {
                $error .= "Email or password is wrong";
                // echo $error;
            } else {
               
                if ($_POST["stayLoggedIn2"]) {
                    setcookie("id", $accountId, time() + 60 * 60 * 60 * 24 * 30, "/");
                    // echo $_SESSION["id"];
                    // echo "cookie setting...: " . $_COOKIE["id"];
                    if ($_COOKIE["id"]){
                        // echo "cooke set";
                    }
                } else {
                    // echo "Not stay logged in";
                }
                $_SESSION["id"] = $accountId;
                header("Location: main-page.php");
            }
        }
    }
}
