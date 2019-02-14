<?php

    class Post {
        private $dbPost;
        private $userId;
        public function __construct($userId) {
            $this->dbPost = new Database;
            $this->userId = $userId;
        }

        public function getPosts() {
            $this->dbPost->query("SELECT * FROM posts WHERE user_id = :user_id");
            $this->dbPost->bind(':user_id',$this->userId);
            $posts = $this->dbPost->resultSet();
            return $posts;
        }

        public function getPost($postId) {
            $this->dbPost->query("SELECT * FROM posts WHERE id = :postId");
            $this->dbPost->bind(':postId',$postId);
            $post = $this->dbPost->single();
            return $post;
        }

        public function postExists($postId) {
            $this->dbPost->query("SELECT * FROM posts WHERE id = :postId");
            $this->dbPost->bind(':postId',$postId);
            $post = $this->dbPost->single();

            if($this->dbPost->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function addPost($data) {
            $this->dbPost->query("INSERT INTO posts(user_id, title, body) VALUES(:user_id, :title, :body)");
            $this->dbPost->bind(':user_id',$this->userId);
            $this->dbPost->bind(':title',$data['title']);
            $this->dbPost->bind(':body',$data['body']);
            
            if($this->dbPost->execute()) {
                return true;
            } else return false;
           
        }
        public function deletePost($postId) {
            $this->dbPost->query("DELETE FROM posts WHERE id = :postId");
            $this->dbPost->bind(':postId',$postId);
            
            if($this->dbPost->execute()) {
                return true;
            } else return false;
        }

        public function updatePost($data) {
            
            $this->dbPost->query("UPDATE posts SET title=:title, body=:body WHERE id =:id");
            $this->dbPost->bind(':title',$data['title']);
            $this->dbPost->bind(':body',$data['body']);
            $this->dbPost->bind(':id',$data['id']);

            if($this->dbPost->execute()) {
                return true;
            } else return false;
        }

    }

?>