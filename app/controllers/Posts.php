<?php

    class Posts extends Controller {
        private $postModel;
        
        //Check if the user has been logged in, in order to grant access to the Posts Page
        public function __construct() {
            if(!isset($_SESSION['user_id'])) {
                redirect('users/login');
            }
            $this->postModel = $this->model('Post',$_SESSION['user_id']);
            
        }

        public function index() {
            $results = $this->postModel->getPosts();


            $data = [
                'posts' => $results,
                'name' => $_SESSION['user_name']
            ];

            $this->view('posts/index',$data);

        }
    }

?>