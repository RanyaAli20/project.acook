<?php
require_once 'Database.php';
require_once 'classPost.php';
require_once 'classrecipe.php';

$db = new Database();
$posts = $db->getPosts();
$db->closeConnection();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة مناشير الطبخ</title>
    <link rel="stylesheet" href="post.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            background-color: wheat;
            color: black;
            padding: 10px 20px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .logo h1 {
            margin: 0;
        }

        .header .nav {
            display: flex;
            align-items: center;
        }

        .header .nav button {
            color: black;
            text-decoration: none;
            margin: 0 10px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
        }

        .header .nav button:hover {
            background-color: orange;
        }

        .main-content {
            display: flex;
            width: 100%;
            max-width: 1200px;
            margin-top: 20px;
            justify-content: space-between;
            margin-left: 100px;
        }

        .sidebar {
            width: 200px;
            padding: 20px;
            background-color: wheat;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            margin-right: 10px;
            margin-left: 20px;
        }

        .search-bar {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .search-bar button {
            padding: 10px;
            background-color: orange;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: white;
        }

        .search-options {
            display: none;
            flex-direction: column;
            margin-top: 10px;
        }

        .search-options input {
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .new-post-button {
            margin-bottom: 20px;
        }

        .new-post-button button {
            width: 100%;
            padding: 10px;
            background-color: orange;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .new-post-button button:hover {
            background-color: white;
        }

        .new-post-button a {
            color: black;
            text-decoration: none;
            display: block;
        }

        .profile-box {
            background-color: wheat;
            color: black;
            padding: 50px;
            border-radius: 10px;
            text-align: center;
            width: 200px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 10px;
        }

        .profile-box button {
            background-color: orange;
            color: black;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .profile-box button:hover {
            background-color: white;
            color: black;
        }

        .container {
            flex-grow: 1;
            padding: 50px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }

        .post {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .top-search-bar {
            width: 100%;
            background-color: #f8f9fa;
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .top-search-bar input[type="text"] {
            width: 50%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .top-search-bar button {
            padding: 10px;
            background-color: orange;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        .top-search-bar button:hover {
            background-color: white;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="logo">
        <h1><br>  𝓟𝓸𝓼𝓽  📋🍜</h1>
    </div>
    <div class="nav">
        <button onclick="window.location.href='home.html'">الصفحة الرئيسية</button>
        <button onclick="window.location.href='logout.html'">تسجيل الخروج</button>
    </div>
</div>

<div class="top-search-bar">
    <input type="text" placeholder="ابحث...">
    <button>🔍 بحث</button>
</div>

<h1>𝓐𝓬𝓸𝓸𝓴𝓮🍳🥘 </h1>

<div class="main-content">
    <div class="sidebar">
        <div class="search-bar">
            <button onclick="toggleSearch()">البحث باستخدام</button>
            <div class="search-options">
                <input type="text" placeholder="ابحث باسم الوصفة...">
                <input type="text" placeholder="ابحث باسم البلد...">
                <input type="text" placeholder="ابحث بالمكونات...">
            </div>
        </div>

        <div class="new-post-button">
        <button onclick="window.location.href='newpost.html'">منشور جديد </button>
        </div>
    </div>

    <div class="container">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $item): ?>
                <div class="post">
                    <h3>المستخدم <?php echo $item['post']->getUserId(); ?></h3>
                    <h4><?php echo $item['post']->getTitle(); ?></h4>
                    <p>المكونات: <?php echo $item['post']->getIngredients(); ?></p>
                    <p>نوع الوجبة: <?php echo $item['post']->getMealType(); ?></p>
                    <p>البلد: <?php echo $item['post']->getCountry(); ?></p>
                    <p>الوصفة: <?php echo $item['recipe']->getContent(); ?></p>
                    <small>تاريخ النشر: <?php echo $item['post']->getCreatedAt(); ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>لا توجد منشورات لعرضها.</p>
        <?php endif; ?>
    </div>

    <div class="profile-box">
        <h2> 💁‍♂️</h2>
        <button onclick="window.location.href='profile.html'">اذهب للصفحة الشخصية</button>
    </div>
</div>

<script>
    function toggleSearch() {
        var searchOptions = document.querySelector('.search-options');
        if (searchOptions.style.display === 'flex') {
            searchOptions.style.display = 'none';
        } else {
            searchOptions.style.display = 'flex';
        }
    }
</script>

</body>
</html>
