<?php
abstract class master_view{
    
    static function get_title(){
        $title="";
        if(ch::get_action()!=""){
            $title=" - ".ucfirst(str_replace('_',' ',ch::get_action()));
        }
        
        $x="<title>Filmlista".$title."</title>";
        return $x;
    }
    
    static function get_head(){
        $x="<!DOCTYPE html>";
        $x.="<head>";
        $x.= self::get_title();
        $x.= self::get_description();
        $x.="</head>";
        $x.="<html>";
        $x.="<body>";
        return $x;
    }
    
    static function get_footer(){
        $x="<footer>";
        $x.="</footer>";
        $x.="</body>";
        $x.="</html>";
        return $x;
    }
    
    static function get_description(){
        $x="<meta name='description' content='".ucfirst(str_replace('_',' ',ch::get_action()))."' />";
        return $x;
    }
    
    static function get_start(){
        $x="<h1>Filmlista</h1>";
        $x.="<p>Soon to come...</p>";
        return $x;
    }
    
    static function get_menu(){
        if ($_SESSION["is_logged_in"]==1){
            $x="";
            $x.="<ul>";
            $x.="<li><a href='/'>Start</a></li>";
            $x.="<li><a href='/movies'>Filmer</a>"
                    . "<ul><li><a href='/show_movies'>Visa filmer</a></li>"
                    . "<li><a href='/add_movie'>L&auml;gg till film</a></li>"
                    . "<li><a href='/add_movie_to_user'>L&auml;gg till film i min lista</a></li>"
                    . "<li><a href='/show_users_movies'>Visa min filmlista</a></li>"
                    . "</ul></li>";
            $x.="<li><a href='/categories'>Kategorier</a>"
                    . "<ul><li><a href='/show_categories'>Visa kategorier</a></li>"
                    . "<li><a href='/add_category'>L&auml;gg till kategori</a></li>"
                    . "</ul></li>";
            $x.="<li><a href='/actors'>Sk&aring;despelare</a>"
                    . "<ul><li><a href='/show_actors'>Visa sk&aring;despelare</a></li>"
                    . "<li><a href='/add_actor'>L&auml;gg till sk&aring;despelare</a></li>"
                    . "</ul></li>";
            $x.="<li><a href='/usergroups'>Anv&auml;ndargrupper</a>"
                    . "<ul><li><a href='/add_usergroup'>L&auml;gg till anv&auml;ndargrupp</a></li>"
                    . "<li><a href='/my_usergroups'>Mina anv&auml;ndargrupper</a></li>"
                    . "</ul></li>";
                    //. "<li><a href='/add_user_to_usergroup'>L&auml;gg till anv&auml;ndare till anv&auml;ndargrupp</a></li>"
                    //. "<li><a href='/remove_user_from_usergroup'>Ta bort anv&auml;ndare fr&aring;n anv&auml;ndargrupp</a></li></ul></li>";
            $x.="<li><a href='/logout'>Logga ut</a></li>";
            $x.="<li><a href='/account'>".user_handler::get_username()."</a></li>";
            $x.="</ul>";
            $x.= search_view::show_searchbox()."<br /><br />";
        }
        else{
            $x="";
            $x.="<ul>";
            $x.="<li><a href='/'>Start</a></li>";
            $x.="<li><a href='/login'>Login</a></li>";
            $x.="<li><a href='/logout'>Logga ut</a></li>";
            $x.="</ul><br /><br />";
        }
        return $x;
    }
}
