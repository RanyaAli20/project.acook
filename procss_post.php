<?php
session_start();
require_once 'Class_Database.php';
require_once 'classpost.php';
require_once 'classrecipe.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'], $_POST['ingredients'], $_POST['recipe'], $_POST['mealType'], $_POST['country'])) {
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $recipeContent = $_POST['recipe'];
    $mealType = $_POST['mealType'];
    $country = $_POST['country'];

    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    } else {
        echo "خطأ: المستخدم غير مسجل.";
        exit();
    }

    $createdAt = date("Y-m-d H:i:s");

    echo "User ID: " . $userId . "<br>";
echo "Title: " . $title . "<br>";
echo "Ingredients: " . $ingredients . "<br>";
echo "Recipe: " . $recipeContent . "<br>";
echo "Meal Type: " . $mealType . "<br>";
echo "Country: " . $country . "<br>";
echo "Created At: " . $createdAt . "<br>";


    $post = new Post(null, $userId, $title, null, $ingredients, $mealType, $country, $createdAt);
    $recipe = new Recipe(null, $recipeContent);

    $db = new Database();
    $result = $db->insertPost($post, $recipe);

    if ($result === true) {
        // إعادة التوجيه إلى صفحة المنشورات بعد النجاح
        header("Location: post.php");
        exit();
    } else {
        echo "فشل في إدخال المنشور: " . $result;
    }

    $db->closeConnection();
} else {
    echo "يرجى ملء جميع الحقول المطلوبة.";
}
?>
