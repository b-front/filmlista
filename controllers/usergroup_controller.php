<?php

class usergroup_controller {

    public function init() {
        $x = "";
        
        if (ch::get_action()=='usergroups'){
            $x.= usergroup_view::show_my_usergroups($_SESSION["logged_in_user"]);
        }
        
        if (ch::get_action()=='my_usergroups'){
            $x.= usergroup_view::show_my_usergroups($_SESSION["logged_in_user"]);
        }
        
        if (ch::get_action()=='add_usergroup'){
            if(ch::verify_post("usergroup_title")){
                $r= usergroup_handler::add_usergroup();
                if($r){
                    $x.='Anv&auml;ndargrupp tillagd!<br/><br/>';
                }else{
                    $x.='Kunde inte l&auml;gga till anv&auml;ndargrupp!<br/><br/>';
                }
            }
            $x.= usergroup_view::get_add_usergroup_form();
        }
        
        if (ch::get_action()=='edit_usergroup'){
            if(ch::verify_post("usergroup_id")){
                $r= usergroup_handler::update_usergroup(ch::get_post("usergroup_id"));
                if($r){
                    $x.='Anv&auml;ndargrupp uppdaterad!<br/><br/>';
                }else{
                    $x.='Kunde inte uppdatera anv&auml;ndargrupp!<br/><br/>';
                }
            }
            $x.= usergroup_view::get_edit_usergroup_form(ch::get_get("usergroup_id"));
        }
        
        if (ch::get_action()=='add_user_to_usergroup'){
            $usergroup=-1;
            $user=-1;
            $r= usergroup_handler::add_user_to_usergroup($usergroup,$user);
            if($r){
                $x.='Anv&auml;ndare tillagd i anv&auml;ndaregrupp!<br/><br/>';
            }else{
                $x.='Du kunde inte l&auml;gga till anv&auml;ndare i anv&auml;ndargrupp!<br/><br/>';
            }
        }
        
        if (ch::get_action()=='leave_usergroup'){
            $r= usergroup_handler::remove_user_from_usergroup(ch::get_get("usergroup_id"),$_SESSION["logged_in_user"]);
            if($r){
                $x.='Du har nu l&auml;mnat gruppen!<br/><br/>';
            }else{
                $x.='Du kunde inte l&auml;mna gruppen!<br/><br/>';
            }
        }
        
        if (ch::get_action()=='remove_user_from_usergroup'){
            $usergroup=-1;
            $user=-1;
            $r= usergroup_handler::remove_user_from_usergroup($usergroup,$user);
            if($r){
                $x.='Användare har nu tagits bort från gruppen!<br/><br/>';
            }else{
                $x.='Kunde inte ta bort användare från gruppen!<br/><br/>';
            }
        }
        
        if (ch::get_action()=='show_all_movies_in_usergroup'){
            $x.= usergroup_view::get_all_movies_in_usergroup(ch::get_get("usergroup_id"));
        }
        
        if (ch::get_action()=='show_common_movies_in_usergroup'){
            $x.= usergroup_view::get_common_movies_in_usergroup(ch::get_get("usergroup_id"));
        }
        
        return $x;
    }

}
