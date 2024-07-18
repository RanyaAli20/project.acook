<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newpost</title>
    <link rel="stylesheet" href="newpost.css">
</head>
<body>
<div class="container">
    <h1>إنشاء منشور جديد</h1>
    <form action="process_post.php" method="POST">

        <div class="form-group">
            <label for="title">العنوان:</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="ingredients">المكونات:</label>
            <textarea id="ingredients" name="ingredients" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="recipe">طريقة الوصفة:</label>
            <textarea id="recipe" name="recipe" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="mealType">نوع الوجبة:</label>
            <select id="mealType" name="mealType">
                <option value="فطور">فطور</option>
                <option value="غداء">غداء</option>
                <option value="عشاء">عشاء</option>
                <option value="وجبة صحية">وجبة صحية</option>
            </select>
        </div>

        <div class="form-group">
        <label for="country">البلد:</label>
        <select id="country" name="country">
            <option value="Libya">ليبيا</option>
            <option value="Egypt">مصر</option>
        </select>
        </div>

        <div class="form-group">
            <button type="submit">نشر المنشور</button>
        </div>
        
    </form>
</div>
</body>
</html>