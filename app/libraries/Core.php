<?php

/* Application Core Class
   URL Format - /controller/method/params
   Ex: /pages/login/1
*/

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        //get URL
        $url = $this->getUrl();

        //Check to see if Controller name exists
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        //Import Controller Class
        require_once '../app/controllers/' . $this->currentController . '.php';
        //Create an instance of that Controller Class
        $this->currentController = new $this->currentController;

        //Get Method
        if(isset($url[1]) && method_exists($this->currentController,$url[1])) {
            $this->currentMethod = $url[1];
            unset($url[1]);
        }
        //Get Params
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
    }
    
    //grab the URL
    public function getUrl() {
        if(isset($_GET['url'])) {
            //remove the last '/' of the URL, if one
            $url = rtrim($_GET['url'],'/');
            //sanitize the URL
            $url = filter_var($url,FILTER_SANITIZE_URL);
            //retrieve and split the URL string
            $url = explode('/',$url);
            //return URL
            return $url;
        }
    }
}

?>