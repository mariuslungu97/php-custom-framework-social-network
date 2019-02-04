<?php

    class User {
        private $db;
        //Create Instance of DB
        public function __construct() {
            $this->db = new Database;
        }

        //Find User By Email
        public function findUserByEmail($email) {
            $this->db->query('SELECT * FROM users WHERE email=:email');
            $this->db->bind(':email',$email);

            $row = $this->db->single();

            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        //register user
        public function registerUser($data) {

            $this->db->query('INSERT INTO USERS(name,email,password) VALUES(:name,:email,:password)');
            
            $this->db->bind(':name',$data['name']);
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':password',$data['password']);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        //login user
        public function login($email,$password) {
            $this->db->query('SELECT * FROM users WHERE email=:email');
            $this->db->bind(':email',$email);

            $row = $this->db->single();

            if($this->db->rowCount() > 0) {
                $hashedPassword = $row->password;

                if(password_verify($password,$hashedPassword)) {
                    return $row;
                } else {
                    return false;   
                }
            } else {
                return false;
            }

            
        }

        public function getUserById($id) {
            $this->db->query('SELECT * FROM users WHERE id=:id');
            $this->db->bind(':id',$id);

            $user = $this->db->single();

            if($this->db->rowCount() > 0) {
                return $user;
            } else {
                return false;
            }

        }

    }

?>
