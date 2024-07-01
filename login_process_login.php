<?php
session_start(); // بدء الجلسة للحفاظ على الحالة بين الصفحات

require_once 'register_Database.php'; // تضمين ملف قاعدة البيانات

if(isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // استعلام للتحقق من وجود المستخدم في قاعدة البيانات
    $db = new Database();
    $user = $db->getUserByUsername($username);

    if($user && password_verify($password, $user['password'])) {
        // تم تسجيل الدخول بنجاح
        $_SESSION['username'] = $username;
        echo "تم تسجيل الدخول بنجاح. مرحباً، $username!";
        // هنا يمكن توجيه المستخدم إلى الصفحة الرئيسية أو أي صفحة أخرى
    } else {
        // فشل تسجيل الدخول
        echo "اسم المستخدم أو كلمة المرور غير صحيحة.";
        // يمكن توجيه المستخدم إلى صفحة تسجيل الدخول مرة أخرى
    }

    $db->closeConnection();
} else {
    echo "الرجاء ملء جميع الحقول المطلوبة.";
}
?>
