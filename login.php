<?php
require_once 'User.php';
require_once 'config.php'; // تضمين ملف التكوين لمعلومات الاتصال بقاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // الحصول على البيانات من النموذج
    $username = $_POST['username'];
    $password = $_POST['password'];

    // البحث عن المستخدم في قاعدة البيانات
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $user = new User($row['username'], $row['password']);

        // التحقق من كلمة المرور
        if ($user->verifyPassword($password)) {
            echo "تم تسجيل الدخول بنجاح للمستخدم: " . htmlspecialchars($user->getUsername());
            // يمكنك هنا تخزين بيانات الجلسة أو إجراءات أخرى بعد تسجيل الدخول بنجاح
        } else {
            echo "فشل تسجيل الدخول. الرجاء التحقق من اسم المستخدم وكلمة المرور.";
        }
    } else {
        echo "اسم المستخدم غير موجود.";
    }

    $stmt->close();
}

// إغلاق الاتصال
$conn->close();
?>
