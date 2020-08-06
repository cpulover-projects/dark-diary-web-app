<?php

if (isset($_POST["submit"])) {
    $error = "";
    if (!$_POST["email"]) {
        $error .= "Email is required";
    }
    if (!$_POST["password"]) {
        $error .= "Password is required";
    } elseif (!$_POST["passwordConfirm"]) {
        $error .= "Please comfirm password";
    } elseif ($_POST["password"] != $_POST["passwordConfirm"]) {
        $error .= "Password does not match";
    }

    if ($error) {
        echo $error;
    } else {
        //authen the sign-up email not been registerd yet
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
            //hash password
            $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

            //create new user
            $query = "INSERT INTO `user` (`email`, `password`) VALUES ('"
            . mysqli_real_escape_string($link, $_POST["email"])
            . "','"
            . mysqli_real_escape_string($link, $hash)
                . "')";

            if (mysqli_query($link, $query)) {
                $_SESSION["id"] = mysqli_insert_id($link);
                if ($_POST["stayLoggedIn"] == "1") {
                    setcookie("id", 1, time() + 60*60, "/");
                }
                header("Location: main-page.php");
            } else {
                echo "Could not sign up. Please try again";
            }
        }
    }
} else {
    // echo "Failed to submit";
}
?>