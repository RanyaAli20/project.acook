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





}
?>