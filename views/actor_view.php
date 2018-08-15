<?php

abstract class actor_view {

    static function show_all_actors() {
        $r= actor_handler::get_all_actors();
        $x="";
        foreach($r as $row){
            $x.="<a href='/show_movies_for_actor?actor_id=".$row[0]."'>".$row[1]."</a>"." <a href='/edit_actor?actor_id=".$row[0]."'>Hantera sk&aring;despelare</a> <a href='/delete_actor?actor_id=".$row[0]."'>Radera sk&aring;despelare</a><br/>";
        }
        return $x;
    }
    
    static function get_add_actor_form(){
        $x="";
        $x.="<form method='post'>";
        $x.="Sk&aring;despelare:<br/>";
        $x.="<input type='text' name='actor_name'/><br/><br/>";
        $x.="<input type='submit' value='L&auml;gg till'/>";
        $x.="</form>";
        return $x;
    }
    
    static function get_edit_actor_form(){
        $r= actor_handler::get_actor(ch::get_get("actor_id"));
        $x="";
        $x.="<form method='post'>";
        $x.="Sk&aring;despelare:<br/>";
        $x.="<input type='text' name='actor_name' value='".$r[1]."'/><br/><br/>";
        $x.="<input type='hidden' name='actor_id' value='".$r[0]."'/>";
        $x.="<input type='submit' value='Uppdatera'/>";
        $x.="</form>";
        return $x;
    }
    
    static function get_movies_for_actor($actor_id){
        $x="";
        $r= actor_handler::get_movies_for_actor($actor_id);
        foreach ($r as $row){
            $x.="<a href='".$row[2]."' target='_blank'>".$row[1]." (".$row[3].")</a><br/>";
        }
        $x.= "<br/><a href='/show_actors'>Tillbaka till sk&aring;despelare</a><br/>";
        return $x;
    }

}
