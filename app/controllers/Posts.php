<?php

    class Posts extends Controller {
        private $postModel;
        private $userModel;
        
        //Check if the user has been logged in, in order to grant access to the Posts Page
        public function __construct() {
            if(!isset($_SESSION['user_id'])) {
                redirect('users/login');
            }
            $this->postModel = $this->model('Post',$_SESSION['user_id']);
            $this->userModel = $this->model('User');
            
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
                        die('Something went wrong, please try adding the post again');
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

        public function show($postId) {
            if($this->postModel->postExists($postId)) {
                $post = $this->postModel->getPost($postId);
                $user = $this->userModel->getUserById($_SESSION['user_id']);
    
                $data = [
                    'post' => $post,
                    'user' => $user
                ];
    
                console_log($data);
    
                $this->view('posts/show',$data);
            } else {
                redirect('posts');

            }
            
        }

        public function edit($postId) {
            //Check if postId param exists
            if($this->postModel->postExists($postId)) {
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                    $data = [
                        'title' => trim($_POST['title']),
                        'body' => trim($_POST['body']),
                        'title_err' => '',
                        'body_err' => '',
                        'id' => $postId
                    ];
    
                    if(empty($data['title'])) {
                        $data['title_err'] = 'Please enter title';
                    }
                    if(empty($data['body'])) {
                        $data['body_err'] = 'Please enter body';
                    }
    
                    if(empty($data['title_err']) && empty($data['body_err'])) {
                        //Add Post
                        if($this->postModel->updatePost($data)) {
                            $msg = "The Post named: " . $data['title'] . " has been edited";
                            flash('edit-success',$msg);
    
                            redirect('posts');
                        } else {
                            die('Something went wrong, please try adding the post again');
                        }
                    } else {
                        //Display view with errors
                        $this->view('posts/edit',$data);
                    }
    
                } else {
                    $post = $this->postModel->getPost($postId);
    
                    $data = [
                        'id' => $postId,
                        'title' => $post->title,
                        'body' => $post->body
                    ];
    
                    $this->view('posts/edit',$data);
                }
            } else {
                //Redirect to home page
                redirect('posts');
            }
            
            
        }

        public function delete($postId) {
            //Check to see if $postId exists
            if($this->postModel->postExists($postId)) {
                //Delete Post
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->postModel->deletePost($postId)) {
                    flash('delete-success', 'The post has been deleted');
                    //Redirect to posts/index
                    redirect('posts');
                } else {
                    die('Something went wrong during the deletion process');
                }
            } else {
                //$postId does not exists. Redirect to posts/index
                redirect('posts');
            }

            
        }
    }

?>