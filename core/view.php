<?php 

class view
{

    static function render($file,$params = []) {

        if (file_exists(VİEWS_PATH."/".$file.".php")) {
            require_once VİEWS_PATH."/".$file.".php";
        }
        else {
            exit($file." görüntü dosyası bulunamadı.");
        }

    }

}

?>