<?php

if (isset($_POST['submit'])) {
    include_once 'dbh.inc.php';
    $first = mysqli_real_escape_string($connection, $_POST['first']);
    $last = mysqli_real_escape_string($connection, $_POST['last']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $uid = mysqli_real_escape_string($connection, $_POST['uid']);
    $pwd = mysqli_real_escape_string($connection, $_POST['pwd']);

    // Error handling
    //check if everything has been filled out (no empty fields)
    if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
        header("Location: ../signup.php?signup=empty");
        exit(); // stops script if error activated
    } else {
        // check if valid input
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
            header("Location: ../signup.php?signup=invalid");
            exit();
        } else {
            // make sure email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../signup.php?signup=email");
                exit();
            } else {
                $sql = "SELECT * FROM users WHERE user_username = '$uid'";
                $result = mysqli_query($connection, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) { // if we have a user already with that username
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
                } else {
                    // hash password
                    $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
                    // insert user into DBS
                    $sql = "INSERT INTO users (user_first_name, user_last_name, user_email, user_username, user_password) 
                            VALUES ('$first', '$last', '$email', '$uid', '$hashedPassword');";
                    mysqli_query($connection, $sql);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../signup.php"); // based on signup.php
    exit();
}