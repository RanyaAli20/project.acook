<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "project";
    private $conn;

    // الاتصال
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // طريقة لإدراج المستخدم في قاعدة البيانات
    public function insertUser(User $user) {
        $username = $this->conn->real_escape_string($user->getUsername());
        $email = $this->conn->real_escape_string($user->getEmail());
        $age = $this->conn->real_escape_string($user->getAge());
        $gender = $this->conn->real_escape_string($user->getGender());
        $country = $this->conn->real_escape_string($user->getCountry());
        $password = $this->conn->real_escape_string($user->getPassword());
        $confirm_password = $this->conn->real_escape_string($user->getConfirmPassword());

        $sql = "INSERT INTO user (username, email, age, gender, Country, password, confirm_password)
                VALUES ('$username', '$email', '$age', '$gender', '$country', '$password', '$confirm_password')";

        if ($this->conn->query($sql) === TRUE) {
            return true; // Return true on successful insertion
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error; // Return error message on failure
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
