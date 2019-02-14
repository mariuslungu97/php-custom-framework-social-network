<?php

    class Users extends Controller {        

        private $userModel;
        public function __construct() {
            $this->userModel = $this->model('User');
        }

        public function register() {
            //Check if form has been submitted
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);

                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['pass']),
                    'confirm_password' => trim($_POST['confirm-pass']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ]; 

                if(empty($_POST['name'])) {
                    $data['name_err'] = 'Please fill in your name.';
                };

                if(empty($_POST['email'])) {
                    $data['email_err'] = 'Please enter your email.';

                } else {

                    if($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = 'The email already exists in our database.';
                    }
                }

                if(empty($_POST['pass'])) {
                    $data['password_err'] = 'Please enter a password.';
                } elseif(strlen($_POST['pass']) < 6) {
                    $data['password_err'] = 'Your password must be at least 6 characters.';
                } else {
                    if($data['password'] != $data['confirm_password']) {
                        $data['password_err'] = 'Passwords do not match.';
                    }   
                };

                if(empty($_POST['confirm-pass'])) {
                    $data['confirm_password_err'] = 'Please re-enter your password.';
                };
                
                //Check if there is any error
                if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    //No Error, Store Data in the DB
                    
                    $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                    //Check if user has been registered
                    if($this->userModel->registerUser($data)) {
                        flash('register_success','You are registered. You can log in!');
                        //Redirect to Login Page
                        redirect('users/login');
                    } else {
                        die('Something went wrong');
                    }
                    
                } else {
                    $this->view('users/register',$data);
                }
                
            } else {
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                $this->view('users/register',$data);
            }
        }

        public function login() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);
                $data = [
                    
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['pass']),
                    
                    'email_err' => '',
                    'password_err' => ''
                    
                ]; 

                if(empty($_POST['email'])) {
                    $data['email_err'] = 'Please enter your email.';
                } 

                if(empty($_POST['pass'])) {
                    $data['password_err'] = 'Please enter a password.';
                }

                if(!$this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'No user has been found. Type your mail again.';
                }

                if(empty($data['email_err']) && empty($data['password_err'])) {
                    
                    //Check and set logged in user
                    $loggedInUser = $this->userModel->login($data['email'],$data['password']);
                    if($loggedInUser) {
                        //Create Session Variables
                        $this->createSessionUser($loggedInUser);

                    } else {
                        $data['password_err'] = 'Incorrect Password! Please try again.';
                        $this->view('users/login',$data);
                    }

                } else {
                    $this->view('users/login',$data);
                }
                
            } else {
                $data = [
                    
                    'email' => '',
                    'password' => '',
                    
                    
                    'email_err' => '',
                    'password_err' => '',
                    
                ];
                //load view
                $this->view('users/login',$data);
            }
        }

        public function logout() {
            //Unset Session Variables
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);

            //Display flash message
            flash('logout-success','You have been logged out succesfully!');

            //Redirect
            redirect('users/login');


        }

        public function createSessionUser($user) {
            

            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;

            redirect('posts/index');

            
        }

        
    }

?>