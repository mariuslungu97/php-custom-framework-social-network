<?php

    class Pages extends Controller {
        public function __construct() {
            //here you should grab the Pages data
        }
        
        public function index() {
            //load the index view and pass the $data assoc array coming from the model
            $data = [
                'title' => 'PostShare Application',
                'description' => 'Basic Social Network Built with Object-Oriented PHP'
            ];
            $this->view('pages/index',$data);
        }

        public function about() {
            $data = [
                'title' => 'About:',
                'description' => "Social Network Built on top of a custom PHP framework, included in the 'app' directory.",
                'version' => '1.0.0',
                'technologyStack' => 'HTML, CSS, PHP 5, PDO'
            ];
            //load the about view
            $this->view('pages/about',$data);
        }
    }

?>