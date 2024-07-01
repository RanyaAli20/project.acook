<?php
session_start();

require_once 'register_Database.php';

try {
    if(isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new Database();
        $user = $db->getUserByUsername($username);

        if($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            echo "تم تسجيل الدخول بنجاح. مرحباً، $username!";
        } else {
            echo "اسم المستخدم أو كلمة المرور غير صحيحة.";
        }

        $db->closeConnection();
    } else {
        throw new Exception("الرجاء ملء جميع الحقول المطلوبة.");
    }
} catch (Exception $e) {
    echo "حدث خطأ: " . $e->getMessage();
}
?>
