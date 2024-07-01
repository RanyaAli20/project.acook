<?php
require_once 'UserClass.php';
require_once 'register_Database.php';

// استقبال البيانات من النموذج
$username = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$country = $_POST['country'];
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
?>
