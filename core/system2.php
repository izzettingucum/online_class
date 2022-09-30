<?php

class system
{

    protected $controller;
    protected $method;
    protected $place = null;

    public function __construct()
    {
        $this->controller = "main";
        $this->method = "index";
        //Adres alma
        if (isset($_GET['act'])) {
            $url = explode("/",filter_var(rtrim($_GET['act'],"/"),FILTER_SANITIZE_URL));
        }
        else {
            $url[0] = $this->controller;
            $url[1] = $this->method;
        }

        if ($url[0] == ADMIN_PATH) {
            $this->place = ADMIN_PATH;
            if (isset($url[1])) {
                $url[0] = $url[0].'/'.$url[1];
            } else {
                $url[0] = $url[0].'/'.$this->controller;
            }
        }
        // Controller dosyası Bulma
        if (file_exists(CONTROLLERS_PATH."/".$url[0].".php")) {
            $this->controller = $url[0];
        }
        else {
            exit($url[0]." dosyası bulunamadı");
        }
       
        require_once CONTROLLERS_PATH."/".$url[0].".php";
        // Class bulma
        if ($this->place != null) {
            $this->controller = str_replace(ADMIN_PATH."/", '', $this->controller);
        }
        if (class_exists($this->controller)) {
            $this->controller = new $this->controller;
            array_shift($url); 
            if ($this->place != null) {
                array_shift($url);   
            }
        }

        else {
            exit($url[0]." class'ı bulunamadı");
        }
        
        //Method bulma
        if (isset($url[0])) {
            if (method_exists($this->controller,$url[0])) {
                $this->method = $url[0];
                array_shift($url);  
            }
            else {
                exit($url[0]." methodu bulunamadı");
            }
        }      

        call_user_func_array([$this->controller,$this->method],$url);
        
    }

}

?>