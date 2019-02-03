<?php

    class Post {
        private $dbPost;
        private $userId;
        public function __construct($userId) {
            $this->dbPost = new Database;
            $this->userId = $userId;
        }
        //Get All Posts
        public function getPosts() {
            $this->dbPost->query("SELECT * FROM posts WHERE user_id = :user_id");
            $this->dbPost->bind(':user_id',$this->userId);
            $posts = $this->dbPost->resultSet();
            return $posts;
        }

        //Get Specific Post
        public function getPost($postId) {
            $this->dbPost->query("SELECT * FROM posts WHERE id = :postId");
            $this->dbPost->bind(':postId',$postId);
            $post = $this->dbPost->single();
            return $post;
        }

        //Add Post
        public function addPost($data) {
            $this->dbPost->query("INSERT INTO posts(user_id,title,body) VALUES(:user_id,:title,:body");
            $this->dbPost->bind(':user_id',$this->userId);
            $this->dbPost->bind(':title',$data['title']);
            $this->dbPost->bind(':body',$data['body']);
            
            if($this->db->execute()) {
                return true;
            } else return false;
           
        }
        //Remove Post
        public function deletePost($postId) {
            $this->dbPost->query("DELETE FROM posts WHERE id = :postId");
            $this->dbPost->bind(':postId',$postId);
            
            if($this->db->execute()) {
                return true;
            } else return false;
        }

        //Update Post
        public function updatePost($data) {
            $instruction = '';
            foreach($data as $key => $value) {
                $instruction .= "$key = $value, ";
            }
            $instruction = rtrim($instruction,',');
            $this->dbPost->query("UPDATE posts SET $instruction WHERE user_id = :user_id");
            $this->dbPost->bind(':user_id',$this->userId);

            if($this->db->execute()) {
                return true;
            } else return false;
        }

    }

?>