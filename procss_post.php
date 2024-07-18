<?php
session_start();

require_once 'Database.php';
require_once 'Post.php';
require_once 'Recipe.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'], $_POST['ingredients'], $_POST['recipe'], $_POST['mealType'], $_POST['country'])) {
    $userId = $_SESSION['user_id'];
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $recipeContent = $_POST['recipe'];
    $mealType = $_POST['mealType'];
    $country = $_POST['country'];

    $recipeQuery = "INSERT INTO recipes (content) VALUES (:content)";
    $recipeStmt = $db->prepare($recipeQuery);
    $recipeStmt->bindParam(':content', $recipeContent);
    $recipeStmt->execute();
    $recipeId = $db->lastInsertId();

    $postQuery = "INSERT INTO posts (userId, title, recipeId, ingredients, mealType, country, createdAt) VALUES (:userId, :title, :recipeId, :ingredients, :mealType, :country, NOW())";
    $postStmt = $db->prepare($postQuery);
    $postStmt->bindParam(':userId', $userId);
    $postStmt->bindParam(':title', $title);
    $postStmt->bindParam(':recipeId', $recipeId);
    $postStmt->bindParam(':ingredients', $ingredients);
    $postStmt->bindParam(':mealType', $mealType);
    $postStmt->bindParam(':country', $country);
    $postStmt->execute();

    $db->closeConnection();

    echo "تم نشر المنشور بنجاح!";
} else {
    throw new Exception("الرجاء ملء جميع الحقول المطلوبة.");
}
?>