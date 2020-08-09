<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$_SESSION["currentNoteId"] = false;
$currentNote=null;
?>