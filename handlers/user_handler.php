<?php
abstract class user_handler{
    
    static function login(){
        if (ch::verify_post("username") && ch::verify_post("password")){
            dbh::init();
            $username=mysqli_real_escape_string(dbh::$con,ch::get_post("username"));
            $password=mysqli_real_escape_string(dbh::$con,ch::get_post("password"));
            dbh::close();
            $login = dbh::sql_select("id","users","username='$username' and password='$password'");
            if ($login==0){
                return false;
            }
            $login = $login[0][0];
            if ($login != null and $login!=""){
                $_SESSION["is_logged_in"]=1;
                $_SESSION["logged_in_user"]=$login[0];
            }
        }
    }
    
    static function register_user(){
        if (ch::verify_post("username") && ch::verify_post("password") && ch::verify_post("mail") && ch::verify_post("nickname")){
            dbh::init();
            $username=mysqli_real_escape_string(dbh::$con,ch::get_post("username"));
            $password=mysqli_real_escape_string(dbh::$con,ch::get_post("password"));
            $mail=mysqli_real_escape_string(dbh::$con,ch::get_post("mail"));
            $nickname=mysqli_real_escape_string(dbh::$con,ch::get_post("nickname"));
            dbh::close();
            dbh::sql_insert("username,password,mail,nickname","users","'$username','$password','$mail','$nickname'");
            self::login();
        }
    }
    
    static function get_username(){
        $r = dbh::sql_select("username", "users", "id=".$_SESSION["logged_in_user"]);
        return $r[0][0];
    }
    
    static function get_mail(){
        $r = dbh::sql_select("mail", "users", "id=".$_SESSION["logged_in_user"]);
        return $r[0][0];
    }
    
    static function get_nickname(){
        $r = dbh::sql_select("nickname", "users", "id=".$_SESSION["logged_in_user"]);
        return $r[0][0];
    }
    
    static function is_admin($user_id){
        if ($user_id==1){
            return true;
        }
        return false;
    }
    
    static function logout(){
        $_SESSION["is_logged_in"]=0;
        $_SESSION["logged_in_user"]=null;
        session_destroy();
        session_start();
    }
    
    static function get_user_id(){
        $r=$_SESSION["logged_in_user"];
        return $r;
    }
}
