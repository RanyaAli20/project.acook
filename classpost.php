<?php
class Post {
    private $id;
    private $userId;
    private $title;
    private $recipeId;
    private $ingredients;
    private $mealType;
    private $country;
    private $createdAt;

    public function __construct($id, $userId, $title, $recipeId, $ingredients, $mealType, $country, $createdAt) {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->recipeId = $recipeId;
        $this->ingredients = $ingredients;
        $this->mealType = $mealType;
        $this->country = $country;
        $this->createdAt = $createdAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getRecipeId() {
        return $this->recipeId;
    }

    public function getIngredients() {
        return $this->ingredients;
    }

    public function getMealType() {
        return $this->mealType;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
}
?>
