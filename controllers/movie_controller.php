<?php

class movie_controller{
    public function init(){
        $x="";
        if (ch::get_action()=='movies'){
            $x.=movie_view::show_all_movies();
        }
        
        if (ch::get_action()=='show_movies'){
            $x.=movie_view::show_all_movies();
        }
        
        if (ch::get_action()=='add_movie'){
            if(ch::verify_post("movie_title")){
                $r=mh::add_movie();
                if($r){
                    $x.='Film tillagd!<br/><br/>';
                }else{
                    $x.='Misslyckades att l&auml;gga till film!<br/><br/>';
                }
            }
            $x.= movie_view::get_add_movie_form();
        }
        
        if (ch::get_action()=='edit_movie'){
            if(ch::verify_post("movie_id")){
                $r=mh::update_movie(ch::get_post("movie_id"));
                if($r){
                    $x.='Film uppdaterad!<br/><br/>';
                }else{
                    $x.='Misslyckades att uppdatera film!<br/><br/>';
                }
            }
            $x.= movie_view::get_edit_movie_form();
        }
        
        if (ch::get_action()=='add_movie_to_user'){
            if(ch::verify_post("user_id")){
                $r=mh::add_movie_to_user(ch::get_post("user_id"));
                if($r){
                    $x.='Listan uppdaterad!<br/><br/>';
                }else{
                    $x.='Misslyckades att uppdatera listan!<br/><br/>';
                }
            }
            $x.= movie_view::add_movie_to_user(user_handler::get_user_id());
        }
        
        if (ch::get_action()=='show_users_movies'){
            $x.=movie_view::get_users_movie_list(user_handler::get_user_id());
        }
        
        return $x;
    }
}

