 <?php

    class Controller {
        public function model($model,$param = NULL) {
            //Require Model
            require_once '../app/models/' . $model . '.php';
            //Instantiate Model
            if($param == NULL) return new $model();
            else return new $model($param);
        }

        public function view($view,$data = []) {
            //Check if view file exists
            if(file_exists('../app/views/' . $view . '.php')) {
                //load view file
                require_once '../app/views/' . $view . '.php';
            }
            else {
                //close the app
                die('View does not exist.');
            }
        }


    }
?>