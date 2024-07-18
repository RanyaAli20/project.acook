<?php
require_once 'classUser.php';
require_once 'Class_Database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new Database();
        $user = $db->getUser($username, $password);

        if ($user) {
            echo "تسجيل الدخول ناجح! مرحباً، " . $user['username'];
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
