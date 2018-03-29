<?php

if (isset($_POST['submit'])) {
    session_start(); // run the session
    session_unset(); //unset all session variables inside browser
    session_destroy(); //eliminate all sessions that were running in the browser
    header("Location: ../index.php"); // go back to the main page
    exit();
}