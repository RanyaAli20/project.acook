<?php
require_once 'UserClass.php';
require_once 'register_Database.php';

try {
    // استقبال البيانات من النموذج
    if(isset($_POST['name'], $_POST['email'], $_POST['age'], $_POST['gender'], $_POST['Country'], $_POST['password'], $_POST['confirm_password'])) {
        $username = $_POST['name'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $country = $_POST['Country'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        // إنشاء كائن User
        $user = new User($username, $email, $age, $gender, $country, $password, $confirmPassword);

        // إنشاء كائن Database
        $db = new Database();

        // إدراج المستخدم في قاعدة البيانات
        $result = $db->insertUser($user);

        // التحقق من نتيجة الإدراج
        if ($result === true) {
            echo "تم إنشاء حساب المستخدم بنجاح";
        } else {
            echo "حدث خطأ أثناء إنشاء حساب المستخدم: " . $result;
        }

        // إغلاق اتصال قاعدة البيانات
        $db->closeConnection();
    } else {
        throw new Exception("الرجاء ملء جميع الحقول المطلوبة.");
    }
} catch (Exception $e) {
    echo "حدث خطأ: " . $e->getMessage();
}
?>
