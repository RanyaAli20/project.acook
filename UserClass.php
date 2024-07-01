<?php
class User {
    private $username;
    private $email;
    private $age;
    private $gender;
    private $country;
    private $password;
    private $confirmPassword;

    // Constructor to initialize user object
    public function __construct($username, $email, $age, $gender, $country, $password, $confirmPassword) {
        $this->username = $username;
        $this->email = $email;
        $this->age = $age;
        $this->gender = $gender;
        $this->country = $country;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    // Method to get username
    public function getUsername() {
        return $this->username;
    }

    // Method to get email
    public function getEmail() {
        return $this->email;
    }

    // Method to get age
    public function getAge() {
        return $this->age;
    }

    // Method to get gender
    public function getGender() {
        return $this->gender;
    }

    // Method to get country
    public function getCountry() {
        return $this->country;
    }

    // Method to get password
    public function getPassword() {
        return $this->password;
    }

    // Method to get confirm password
    public function getConfirmPassword() {
        return $this->confirmPassword;
    }
}
?>
