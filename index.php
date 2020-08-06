<?php

session_start();
include "process/connect-database.php";
include "process/logout.php";
include "process/validate-input.php";
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

    <!-- Create hidden field to distinguish between sign up and sign in -->
    <input type="hidden" name="signUp" value="1">
</form>

<form action="" method="post">
    <input type="email" name="email" id="email" placeholder="Enter email">
    <input type="password" name="password" id="password" placeholder="Enter password">
    <input type="checkbox" name="stayLoggedIn" id="stayLoggedIn">
    <label for="stayLoggedIn">Stay logged in</label>
    <input type="submit" name="submit" value="Sign in">

    <!-- Create hidden field to distinguish between sign up and sign in -->
    <input type="hidden" name="signIn" value="1">
</form>
