<?php

include_once "../lib/Database.php";
include_once "../helper/Validator.php";

class Register{

    public $db;
    public $validator;

    public function __construct()
    {
        $this->db = new Database();
        $this->validator = new Validator();
    }

    public function addUser($data) {
        // Validate form fields
        $name = $this->validator->validation($data['fullName']);
        $email = $this->validator->validation($data['email']);
        $mobile = $this->validator->validation($data['mobileNumber']);
        $password = $this->validator->validation($data['password']);
 
        $v_token = md5(rand());
    
        // Check if any field is empty
        if (empty($name) || empty($email) || empty($mobile) || empty($password) ) {
            return "All fields are required.";
        }
    
        // Check if email already exists
        $e_query = "SELECT * FROM users WHERE email = '$email'";
        $email_check = $this->db->select($e_query);
    
        if ($email_check != false && mysqli_num_rows($email_check) > 0) {
            return "Email already exists.";
        }
    
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
        // Insert user into the database
        $query = "INSERT INTO users (full_name, email, mobile_number, password, v_token) VALUES ('$name', '$email', '$mobile',  '$hashed_password', '$v_token')";
        $insert = $this->db->insert($query);
    
        if ($insert) {
            return "User registered successfully.";
        } else {
            return "Error: Could not register user.";
        }
    }

}
    

