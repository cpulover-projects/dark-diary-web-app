<?php
include "properties.php"; //import database properties from secured file
$link = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_error()) {
    die("Failed to connect to database<br>");
} else {
    echo "Connect to database successfully<br>";
}

if (array_key_exists("submit", $_POST)) {
    $error="";
    if(!$_POST["email"]){
        $error.="Email is required";
    }
    if(!$_POST["password"]){
        $error.="Password is required";
    } elseif(!$_POST["passwordConfirm"]){
        $error.="Please comfirm password";
    } elseif($_POST["password"]!=$_POST["passwordConfirm"]){
        $error.="Password does not match";
    } 

    if($error){
        echo $error;
    } else {
        //authen the sign-up email not been registerd yet
        $emailExisted=false; 
        $query="SELECT `email` FROM `user`";
        if($result=mysqli_query($link,$query)){
            while ($row = mysqli_fetch_array($result)){
                if($row["email"]==$_POST["email"]){
                    $emailExisted=true;
                }
            }
        }

        if($emailExisted){
            $error.="This email is already registered";
            echo $error;
        } else {
            //create new user
            $query="INSERT INTO `user` (`email`, `password`) VALUES ('"
            .mysqli_real_escape_string($link, $_POST["email"])
            ."','"
            .mysqli_real_escape_string($link, $_POST["password"])
            ."')";

            if(mysqli_query($link,$query)){
                echo "Sign up successfully";
            } else {
                echo "Could not sign up. Please try again";
            }

        }
    }
} else {
    echo "Failed to submit";
}
?>

<br>
<h4>Keep your darkness secrets here. I will not tell anyone!</h4>
<form action="" method="post">
    <input type="email" name="email" id="email" placeholder="Enter email">
    <input type="password" name="password" id="password" placeholder="Enter password">
    <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm password">
    <input type="checkbox" name="stayLoggedIn" id="stayLoggedIn">
    <label for="stayLoggedIn">Stay logged in</label>
    <input type="submit" name="submit" value="Sign up">
</form>

<form action="" method="post">
    <input type="email" name="email" id="email" placeholder="Enter email">
    <input type="password" name="password" id="password" placeholder="Enter password">
    <input type="checkbox" name="stayLoggedIn" id="stayLoggedIn">
    <label for="stayLoggedIn">Stay logged in</label>
    <input type="submit" name="submit" value="Sign in">
</form>
