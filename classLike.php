<?php
class Like {
    private $id;
    private $userId;
    private $postId;
    private $createdAt;

    public function __construct($id, $userId, $postId, $createdAt) {
        $this->id = $id;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->createdAt = $createdAt;
    }
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getPostId() {
        return $this->postId;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
}

?>