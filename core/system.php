<?php

class system
{

    protected $directory;
    protected $controller;
    protected $method;

    public function __construct()
    {

        $this->controller = "main";
        $this->method = "index";
        $this->directory = '';

        if (isset($_GET['act'])) {
            $url = explode("/", filter_var(rtrim($_GET['act'], "/"), FILTER_SANITIZE_URL));
            if (in_array($url[0], PATHS)) {
                $this->directory = $url[0];
                array_shift($url);
                if (count($url) == 0) {
                    $url[0] = $this->controller;
                    $url[1] = $this->method;
                }
                else if (count($url) == 1) {
                    $url[1] = $this->method;
                }
            }
        }
        else {
            $this->directory = "main";
            $url[0] = $this->controller;
            $url[1] = $this->method;
        }

        // Controller Bulma
        if (file_exists(CONTROLLERS_PATH . "/" . $this->directory . '/' . $url[0] . ".php")) {
            $this->controller = $url[0];
        } /* else if($this->directory != '' && file_exists(CONTROLLERS_PATH."/".$this->directory.'/'.$this->controller.".php")) {
             $url[1] = $url[0];
             $url[0] = $this->controller;
            } */
        else {
            exit($url[0] . " dosyası bulunamadı");
        }

        require_once CONTROLLERS_PATH . "/" . $this->directory . '/' . $url[0] . ".php";

        if (class_exists($this->controller)) {
            $this->controller = new $this->controller;
            array_shift($url);
        }

        else {
            exit($url[0] . " class'ı bulunamadı");
        }

        //Method bulma

        if (isset($url[0])) {

            if (method_exists($this->controller, $url[0])) {
                $this->method = $url[0];
                array_shift($url);
            }
            else {
                exit($url[0] . " methodu bulunamadı");
            }
        }

        call_user_func_array([$this->controller, $this->method], $url);

    }


}

?>