<?php
class User {
    private $username;
    private $email;
    private $age;
    private $gender;
    private $country;
    private $password;
    private $confirmPassword;

  
    public function __construct($username, $email, $age, $gender, $country, $password, $confirmPassword) {
        $this->username = $username;
        $this->email = $email;
        $this->age = $age;
        $this->gender = $gender;
        $this->country = $country;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAge() {
        return $this->age;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getConfirmPassword() {
        return $this->confirmPassword;
    }
}
?>
