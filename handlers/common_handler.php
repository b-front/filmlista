<?php
abstract class ch{
    
    static function get_post($param){
        return $_POST["$param"];
    }
    
    static function get_get($param){
        return $_GET["$param"];
    }
    
    static function verify_post($param){
        if(isset($_POST["$param"]) && $_POST["$param"] != ""){
            return true;
        }
        return false;
    }
    
    static function verify_get($param){
        if(isset($_GET["$param"]) && $_GET["$param"] != ""){
            return true;
        }
        return false;
    }
    
    static function redirect($url=null){
        if ($url==null){
            $url=config::get_base_url();
        }
        header("Location: ".$url);
        die();
    }
    
    static function get_action(){
        $filename = "index.php";
        $root = str_replace("/" . $filename, "", $_SERVER["SCRIPT_NAME"]);
        $requestURI = str_replace($root, "", $_SERVER["REQUEST_URI"]);
        $requestURI = explode("?", $requestURI);
        $requestURI = $requestURI[0];
        $reqParams = explode("/", $requestURI);
        $action = strtolower($reqParams[1]);
        return $action;
    }
}

