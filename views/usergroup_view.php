<?php

abstract class usergroup_view {

    static function show_my_usergroups() {
        $r= usergroup_handler::get_users_usergroups($_SESSION["logged_in_user"]);
        $x="";
        foreach($r as $row){
            $x.="<a href='/show_all_movies_in_usergroup?usergroup_id=".$row[0]."'>".$row[1]."</a> <a href='/edit_usergroup?usergroup_id=".$row[0]."'>Hantera grupp</a> <a href='/leave_usergroup?usergroup_id=".$row[0]."'>L&auml;mna grupp</a><br/>";
        }
        return $x;
    }
    
    static function get_add_usergroup_form(){
        $x="";
        $x.="<form method='post'>";
        $x.="Anv&auml;ndargrupp:<br/>";
        $x.="<input type='text' name='usergroup_title'/><br/><br/>";
        $x.="<input type='submit' value='L&auml;gg till'/>";
        $x.="</form>";
        return $x;
    }
    
    static function get_edit_usergroup_form(){
        $usergroup_id=ch::get_get("usergroup_id");
        $r= usergroup_handler::get_usergroup($usergroup_id);
        $x="";
        $x.="<form method='post'>";
        $x.="Anv&auml;ndargrupp:<br/>";
        $x.="<input type='text' name='usergroup_title' value='".$r[1]."'/><br/><br/>";
        $x.= self::get_user_dropdown($usergroup_id);
        $x.="<input type='hidden' name='usergroup_id' value='".$r[0]."'/>";
        $x.="<input type='submit' value='Uppdatera'/>";
        $x.="</form>";
        return $x;
    }
    
    static function get_user_dropdown($usergroup_id){
        $x="";
        $x.="<select multiple='multiple' size='5' name='users[]' style='width:100px'>";
        $r=usergroup_handler::get_users_in_usergroup($usergroup_id);
        foreach ($r as $row){
            $x.="<option value='".$row[0]."'";
            if($row[2]==1){
                $x.=" selected='selected'";
            }
            $x.=">".$row[1]."</option>";
        }
        $x.="</select><br/>";
        return $x;
    }
    
    static function get_all_movies_in_usergroup($usergroup_id){
        $x="";
        $r=usergroup_handler::get_usergroup_name($usergroup_id);
        foreach ($r as $row){
            $x.="<p>Alla filmer som medlemmar i ".$row[0]." vill se</p>";
        }
        
        $r= usergroup_handler::get_all_movies_in_usergroup($usergroup_id);
        foreach($r as $row){
            $x.="<a href='".$row[2]."' target='_blank'>".$row[1]." (".$row[3].")</a> <br/>";
        }
        $x.="<br/><a href='/show_common_movies_in_usergroup?usergroup_id=".$usergroup_id."'>Visa filmer alla vill se</a><br/>";
        return $x;
    }
    
    static function get_common_movies_in_usergroup($usergroup_id){
        $x="";
        $r=usergroup_handler::get_usergroup_name($usergroup_id);
        foreach ($r as $row){
            $x.="<p>Filmer som alla i ".$row[0]." vill se</p>";
        }
        
        $r= usergroup_handler::get_common_movies_in_usergroup($usergroup_id);
        foreach($r as $row){
            $x.="<a href='".$row[2]."' target='_blank'>".$row[1]." (".$row[3].")</a> <br/>";
        }
        $x.="<br/><a href='/show_all_movies_in_usergroup?usergroup_id=".$usergroup_id."'>Visa alla filmer som n&aring;gon i gruppen vill se</a><br/>";
        return $x;
    }

}
