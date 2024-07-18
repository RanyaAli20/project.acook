<?php
class Post {
    private $id;
    private $user_id ;
    private $title;
    private $ingredients;
    private $recipe_id;
    private $meal_type;
    private $country;
    private $created_at;

    public function __construct($id, $user_id , $title, $ingredients , $recipe_id  , $meal_type , $country, $created_at) {
        $this->id = $id;
        $this->user_id  = $user_id ;
        $this->title = $title;
        $this->recipe_id  = $recipe_id ;
        $this->ingredients = $ingredients;
        $this->meal_type = $meal_type;
        $this->country = $country;
        $this->created_at = $created_at;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id ;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getRecipeId() {
        return $this->recipe_id ;
    }

    public function getIngredients() {
        return $this->ingredients;
    }

    public function getMealType() {
        return $this->meal_type;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }
}
?>
