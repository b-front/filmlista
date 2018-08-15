<?php

class actor_controller {

    public function init() {
        $x = "";
        
        if (ch::get_action()=='actors'){
            $x.= actor_view::show_all_actors();
        }
        
        if (ch::get_action()=='show_actors'){
            $x.= actor_view::show_all_actors();
        }
        
        if (ch::get_action()=='add_actor'){
            if(ch::verify_post("actor_name")){
                $r=actor_handler::add_actor();
                if($r){
                    $x.='Sk&aring;despelare tillagd!<br/><br/>';
                }else{
                    $x.='Misslyckades att l&auml;gga till sk&aring;despelare!<br/><br/>';
                }
                $_POST=array();
            }
            $x.= actor_view::get_add_actor_form();
        }
        
        if (ch::get_action()=='edit_actor'){
            if(ch::verify_post("actor_id")){
                $r=actor_handler::update_actor(ch::get_post("actor_id"));
                if($r){
                    $x.='Sk&aring;despelare uppdaterad!<br/><br/>';
                }else{
                    $x.='Misslyckades att uppdatera sk&aring;despelare!<br/><br/>';
                }
            }
            $x.= actor_view::get_edit_actor_form();
        }
        
        if (ch::get_action()=='delete_actor'){
            if(ch::verify_get("actor_id")){
                $r=actor_handler::delete_actor(ch::get_get("actor_id"));
                if($r){
                    $x.='Sk&aring;despelare raderad!<br/><br/>';
                }else{
                    $x.='Misslyckades att radera sk&aring;despelare!<br/><br/>';
                }
            }
            $x.= actor_view::show_all_actors();
        }
        
        if(ch::get_action()=='show_movies_for_actor'){
            $x.= actor_view::get_movies_for_actor(ch::get_get("actor_id"));
        }
        
        return $x;
    }

}
