<?php

include_once("../config/db.php");

class UserModel {

    public function login($email, $password) {

        global $conn;

        $sql = "SELECT * FROM users
                WHERE email='$email'
                AND password_hash='$password'
                AND role='staff'
                AND is_active=1";

        $result = $conn->query($sql);

        return $result;
    }
}

?>