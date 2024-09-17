<?php

include_once "../lib/Session.php";
Session::init();

include_once '../lib/Database.php';
$db = new Database();

if(isset($_GET['token'])) {
    $token = $_GET['token'];

    // Use a prepared statement to prevent SQL injection
    $query = "SELECT v_token, v_status FROM users WHERE v_token = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if($row['v_status'] == 0) {
            // Update the status to verified
            $update_status = "UPDATE users SET v_status = 1 WHERE v_token = ?";
            $update_stmt = $db->prepare($update_status);
            $update_stmt->bind_param('s', $token);
            $update_result = $update_stmt->execute();

            if($update_result) {
                $_SESSION['status'] = "Your account has been verified. Please login.";
                header("Location: login.php");
                exit(); // Make sure to exit after header redirection
            } else {
                $_SESSION['status'] = "Something went wrong. Please try again.";
                header("Location: login.php");
                exit(); // Make sure to exit after header redirection
            }
        } else {
            $_SESSION['status'] = "This token is already verified. Please login.";
            header("Location: login.php");
            exit(); // Make sure to exit after header redirection
        }
    } else {
        $_SESSION['status'] = "This token does not exist.";
        header("Location: login.php");
        exit(); // Make sure to exit after header redirection
    }
} else {
    $_SESSION['status'] = "Something went wrong. Please try again.";
    header("Location: login.php");
    exit(); // Make sure to exit after header redirection
}
