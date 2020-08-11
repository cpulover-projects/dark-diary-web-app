<?php
 
//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';
 
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
 
//Set the OAuth 2.0 Client ID
$google_client->setClientId('1041610928916-qnns7lkk8ss2dt3h0eu83ampi5pjuh7l.apps.googleusercontent.com');
 
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('pt2YlMeO66lchtVzuMAZWd5H');
 
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://justacpulover.com/projects/the-dark-diary/main-page.php');
 
//
$google_client->addScope('email');
 
$google_client->addScope('profile');
 
//start session on web page
if (!isset($_SESSION)) {
    session_start();
}
 
?>