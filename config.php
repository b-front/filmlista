<?php
abstract class config{
    static private $db_host = "mysql74.unoeuro.com";
    static private $db_user = "enkelt_de";
    static private $db_pass = "Vl4dz0mb";
    static private $db = "enkelt_de_db";
    static private $base_url = "http://filmlista.enkelt.de";
    static private $imdb_credentials = "nbZraGhyB8KXJLJfnkwoFed5SaQr6i";
    
    static function get_db_host(){
        return self::$db_host;
    }
    
    static function get_db_user(){
        return self::$db_user;
    }
    
    static function get_db_pass(){
        return self::$db_pass;
    }
    
    static function get_db(){
        return self::$db;
    }
    
    static function get_base_url(){
        return self::$base_url;
    }
    
    static function get_imdb_credentials(){
        return self::$imdb_credentials;
    }

}
