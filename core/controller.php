<?php 

class controller
{
public $sessionManager;
public function __construct()
{
    $this->sessionManager = new sessionManager();
}

public function render($file,$params = []) 
{
    return view::render($file,$params);
}

public function model($folder,$file)
{
    if (file_exists(MODELS_PATH."/".$folder."/".$file.".php"))
    {
        require_once MODELS_PATH."/".$folder."/".$file.".php";
        if (class_exists($file)) 
        {
            return new $file;
        }
        else 
        {
            exit ($file." adında bir class bulunamadı");
        }
    }

    else 
    {
        exit($file." böyle bir model dosyası bulunamadı.");
    }

}

}

?>