<?php

include_once '../lib/Database.php';
include_once '../helper/validator.php';
include_once '../PHPmailer/PHPMailer.php';
include_once '../PHPmailer/SMTP.php';
include_once '../PHPmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Register {
    public $db;
    public $validator;

    public function __construct() {
        $this->db = new Database(); 
        $this->validator = new validation();
    }

    public function addUser($data) {
        $fullName = $this->validator->validation($data['fullName']);
        $email = $this->validator->validation($data['email']);
        $mobileNumber = $this->validator->validation($data['mobileNumber']);
        $password = $this->validator->validation($data['password']);
        $v_token = md5(rand());

        // Validate required fields
        if (empty($fullName) || empty($email) || empty($mobileNumber) || empty($password)) {
            return "Field Must Not Be Empty";
        } else {
            // Check if email already exists
            $e_query = "SELECT * FROM users WHERE email = '$email'";
            $check_email = $this->db->select($e_query);
            
            if ($check_email != false) {
                return "Email Already Exists";
            } else {
                // Hash password before inserting
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert the user into the database
                $insert_query = "INSERT INTO users(full_name, email, mobile_number, password, v_token) 
                                 VALUES('$fullName', '$email', '$mobileNumber', '$hashed_password', '$v_token')";
                $insert_row = $this->db->insert($insert_query);
                
                if ($insert_row) {
                    // Send verification email after successful registration
                    $this->sendmail_verify($fullName, $email, $v_token);
                    $success = "Registration Successful. Please, check your email to verify your account.";
                    return $success;
                } else {
                    return "Registration Failed! Try Again";
                }
            }
        }
    }

    public function sendmail_verify($fullName, $email, $v_token) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'mihirkantho@gmail.com';                 // Gmail username (replace with env variable)
            $mail->Password   = 'iolpohixeiajvqtn';                            // Gmail password (replace with env variable)
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to

            // Recipients
            $mail->setFrom('kanthomihir@gmail.com', 'Admin');            // Set your sender email
            $mail->addAddress($email, $fullName);                       // Add recipient

            // Content
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'Email Verification';
            $email_template = "
                <h2>Email Verification</h2>
                <p>Hi $fullName,</p>
                <p>Thank you for registering with us.</p>
                <p>Please click <a href='http://localhost/starter-project/admin/verify-email.php?v_token=$v_token'>here</a> to verify your email address.</p>";
            $mail->Body = $email_template;

            $mail->send();
           
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

