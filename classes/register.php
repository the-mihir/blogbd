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

    public function addUser($data){
        $name = $this->validator->validation($data['fullName']);
        $email = $this->validator->validation($data['email']);
        $mobile = $this->validator->validation($data['mobileNumber']);
        $password = $this->validator->validation($data['password']);
        $v_token = md5(rand());

        $e_query = "SELECT * FROM users WHERE email = '$email'";

        $email_check = $this->db->select($e_query);

        if($email_check != false && count($email_check) > 0){
            $error = "Email Already Exists";
            // if field is empty 
            if(empty($name) || empty($email) || empty($mobile) || empty($password)){
                $error = "All Fields Are Required";
            }
            return $error;
        }else{
            $query = "INSERT INTO users(name, email, mobile, password, v_token) VALUES('$name', '$email', '$mobile', '$password', '$v_token')";
            $insert = $this->db->insert($query);
            header("Location:register.php");
            if($insert){
                return true;
            }else{
                return false;
            }
        }   

    }
}

