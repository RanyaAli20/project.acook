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

    public function getPosts() {
        try {
            $sql = "SELECT posts.id, posts.user_id, posts.title, posts.recipe_id, posts.ingredients, posts.meal_type, posts.country, posts.created_at, recipe.content 
                    FROM posts 
                    JOIN recipe ON posts.recipe_id = recipe.id";
            $result = $this->conn->query($sql);

            $posts = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $recipe = new Recipe($row['recipe_id'], $row['content']);
                    $post = new Post(
                        $row['id'],
                        $row['user_id'],
                        $row['title'],
                        $row['recipe_id'],
                        $row['ingredients'],
                        $row['meal_type'],
                        $row['country'],
                        $row['created_at']
                    );
                    $posts[] = ['post' => $post, 'recipe' => $recipe];
                }
            }
            return $posts;
        } catch (Exception $e) {
            return [];
        }
    }

    public function insertPost(Post $post, Recipe $recipe) {
        try {
            $this->conn->begin_transaction();

            // إدخال الوصفة في جدول الوصفات
            $recipeContent = $this->conn->real_escape_string($recipe->getContent());
            $recipeStmt = $this->conn->prepare("INSERT INTO recipes (content) VALUES (?)");
            $recipeStmt->bind_param("s", $recipeContent);
            $recipeStmt->execute();
            $recipeId = $this->conn->insert_id;

            // إدخال المنشور في جدول المنشورات
            $userId = $this->conn->real_escape_string($post->getUserId());
            $title = $this->conn->real_escape_string($post->getTitle());
            $ingredients = $this->conn->real_escape_string($post->getIngredients());
            $mealType = $this->conn->real_escape_string($post->getMealType());
            $country = $this->conn->real_escape_string($post->getCountry());
            $createdAt = $this->conn->real_escape_string($post->getCreatedAt());

            $postStmt = $this->conn->prepare("INSERT INTO posts (username, title, ingredients, recipe_id, meal_type, country, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $postStmt->bind_param("issssss", $userId, $title, $ingredients, $recipeId, $mealType, $country, $createdAt);
            $postStmt->execute();

            $this->conn->commit();

            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            return $e->getMessage();
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
