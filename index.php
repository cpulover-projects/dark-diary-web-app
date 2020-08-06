<?php

session_start();
include "services/connect-database.php";
include "services/logout.php";
include "services/validate-input.php";
?>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="resources/css/style.css">

    <title>The Dark Diary</title>

    <style>
        html {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(resources/images/bg.jpg) no-repeat center center fixed;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="display-3 text-danger">The Dark Diary</div>
        <div class="display-4">Keep your darkness <b>secrets</b> here</div>
        <p><i>(I will not tell anyone!)</i></p>
        <br>

        <!-- SIGN UP FORM -->
        <div id="signUpForm">
        <form action="" method="post">
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Enter email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Enter password" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm password" class="form-control">
            </div>
            <div class="form-group">
                <input type="checkbox" name="stayLoggedIn" id="stayLoggedIn">
            <label for="stayLoggedIn">Remember me</label>
            </div>
            <input type="submit" name="submit" class="btn btn-success" value="Sign up">

            <!-- Create hidden field to distinguish between sign up and sign in -->
            <input type="hidden" name="signUp" value="1">
        </form>

        Already have an account? <a class="toggleForms text-primary"> Sign in</a>
        </div>

        <!-- SIGN IN FORM -->
        <div id="signInForm">
        <form action="" method="post">
        <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Enter email" class="form-control">
            </div>
            <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Enter password" class="form-control">
            </div>
            <div class="form-group">
            <input type="checkbox" name="stayLoggedIn" id="stayLoggedIn">
            <label for="stayLoggedIn">Remember me</label>
            </div>
            
            <input type="submit" name="submit" class="btn btn-primary" value="Sign in">

            <!-- Create hidden field to distinguish between sign up and sign in -->
            <input type="hidden" name="signIn" value="1">
        </form>
        Don't have an account? <a class="toggleForms text-primary"> Sign up</a>
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    <!-- Custom scripts -->
    <script src="resources/js/script.js"></script>
    
</body>

</html>