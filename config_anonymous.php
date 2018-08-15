<?php
abstract class config{
    static private $db_host = "host";
    static private $db_user = "db_user";
    static private $db_pass = "db_pass";
    static private $db = "db_name";
    static private $base_url = "base_url";
    static private $imdb_credentials = "imdb_credentials";
    
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
