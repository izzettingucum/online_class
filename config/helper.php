<?php 

class helper
{
    static function redirect($url)
    {
        if ($url) {
            if (!headers_sent()) {
                header("location:".$url);
            }
            else {
                echo "<a href=".$url."></a>";
            }
        }
    }

    static function cleaner($text)
    {
        $array = ["insert","select","union","delete","update"];
        $text = str_replace($array,'',$text);
        $text = strip_tags($text);
        $text = trim($text);
        return $text;
    }

    static function flashData($key,$value)
    {
        $_SESSION[$key] = $value;
    }

    static function flashDataView($key)
    {
        if (isset($_SESSION[$key])) {
            $sonuc = $_SESSION[$key];
            unset($_SESSION[$key]);
            return($sonuc);
        }
    }
}

?>