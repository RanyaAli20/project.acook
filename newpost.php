<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newpost</title>
</head>
<body>
    <form action="process_post.php" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="ingredients">Ingredients:</label><br>
        <textarea id="ingredients" name="ingredients" rows="4" required></textarea><br><br>

        <label for="meal_type">Meal Type:</label><br>
        <input type="text" id="meal_type" name="meal_type" required><br><br>

        <label for="country">Country:</label><br>
        <input type="text" id="country" name="country" required><br><br>

        <label for="recipe_content">Recipe Content:</label><br>
        <textarea id="recipe_content" name="recipe_content" rows="8" required></textarea><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>