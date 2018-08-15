<?php

class master_controller{
    public function init(){
        require_once 'config.php';
        require_once 'api/IMDbapi.php';
        foreach (glob("controllers/*.php") as $filename){
            require_once $filename;
        }
        foreach (glob("handlers/*.php") as $filename){
            require_once $filename;
        }
        foreach (glob("views/*.php") as $filename){
            require_once $filename;
        }
        $x="";
        
        $x.= master_view::get_head();
        
        $x.= master_view::get_menu();
        
        if (ch::get_action()=='login' || ch::get_action()=='registration'){
            $x.= login_view::get_form();
        }
        
        if (ch::get_action()=='register_user'){
            user_handler::register_user();
            $x.='V&auml;lkommen '.user_handler::get_nickname();
        }
        
        if (ch::get_action()=='login_user'){
            $r=user_handler::login();
            if ($r==0){
                $x.='Din inloggning misslyckades.<br />';
                $x.= login_view::get_form();
            }
            else{
                $x.='V&auml;lkommen tillbaka '.user_handler::get_nickname();
            }
        }
        
        if (in_array(ch::get_action(), array('movies','show_movies','add_movie','edit_movie','add_movie_to_user','show_users_movies'))){
            $mc = new movie_controller();
            $x.=$mc->init();
        }
               
        if (in_array(ch::get_action(), array('categories','show_categories','add_category','remove_category','show_movies_in_category'))){
            $cc = new category_controller();
            $x.=$cc->init();
        }
        
        if (in_array(ch::get_action(), array('actors','show_actors','add_actor','edit_actor','delete_actor','show_movies_for_actor'))){
            $ac = new actor_controller();
            $x.=$ac->init();
        }
        
        if (in_array(ch::get_action(), array('usergroups','add_usergroup','add_user_to_usergroup','leave_usergroup','remove_user_from_usergroup','my_usergroups','edit_usergroup','show_all_movies_in_usergroup','show_common_movies_in_usergroup'))){
            $ugc = new usergroup_controller();
            $x.=$ugc->init();
        }
        
        if (in_array(ch::get_action(), array('search'))){
            $sc = new search_controller();
            $x.=$sc->init();
        }
        
        if (ch::get_action()=='logout'){
            user_handler::logout();
            ch::redirect();
        }
        
        if (ch::get_action()==''){
            $x.= master_view::get_start();
        }
        
        $x.= master_view::get_footer();
        echo $x;
    }
}

