<?php
require_once 'Class_Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id'])) {
    $postId = intval($_POST['post_id']);
    $db = new Database();
    $db->deletePost($postId);
    $db->closeConnection();

    // إعادة التوجيه إلى صفحة المنشورات بعد الحذف
    header("Location: post.php");
    exit();
}
?>
