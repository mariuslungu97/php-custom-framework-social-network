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

        public function add() {
            
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => ''
                ];

                if(empty($data['title'])) {
                    $data['title_err'] = 'Please enter title';
                }
                if(empty($data['body'])) {
                    $data['body_err'] = 'Please enter body';
                }

                if(empty($data['title_err']) && empty($data['body_err'])) {
                    //Add Post
                    if($this->postModel->addPost($data)) {
                        flash('add-success','The Post has been added.');

                        redirect('posts');
                    } else {

                    }
                } else {
                    //Display view with errors
                    $this->view('posts/add',$data);
                }

            } else {
                $data = [
                    'title' => '',
                    'body' => ''
                ];
                //Load View
                $this->view('posts/add',$data);
                //Check for submit button
    
            }
        }
    }

?>