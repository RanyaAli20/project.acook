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

    $userId = $_SESSION['username']; // نفترض أن معرف المستخدم يتم تخزينه في الجلسة عند تسجيل الدخول
    $createdAt = date("Y-m-d H:i:s");

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
