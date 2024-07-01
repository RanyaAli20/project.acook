<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "project";
    private $conn;

    // الاتصال
    public function __construct() {
        try {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    // طريقة لإدراج المستخدم في قاعدة البيانات
    public function insertUser(User $user) {
        try {
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
                return true; 
            } else {
                throw new Exception("Error: " . $sql . "<br>" . $this->conn->error);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getUser($username, $password) {
        try {
            $username = $this->conn->real_escape_string($username);
            $password = $this->conn->real_escape_string($password);

            $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

            $result = $this->conn->query($sql);

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>