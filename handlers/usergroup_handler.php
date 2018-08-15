<?php

abstract class usergroup_handler {

    static function get_users_usergroups($user_id){
        dbh::init();
        $id= mysqli_real_escape_string(dbh::$con,$user_id);
        $r=dbh::sql_return("select ug.id,ug.title from usergroups ug inner join map_user_usergroup muu on ug.id=muu.usergroup_id and muu.user_id=".$id);
        return $r;
    }
    
    static function add_usergroup(){
        dbh::init();
        $title= mysqli_real_escape_string(dbh::$con,ch::get_post("usergroup_title"));
        $usergroup_id=dbh::sql_insert_get_id("title", "usergroups", "'$title'");
        $r= dbh::sql_insert("user_id,usergroup_id", "map_user_usergroup", $_SESSION["logged_in_user"].",".$usergroup_id); 
        dbh::close();
        return $r;
    }
    
    static function update_usergroup($usergroup_id){
        dbh::init();
        $id= mysqli_real_escape_string(dbh::$con,$usergroup_id);
        $title= mysqli_real_escape_string(dbh::$con,ch::get_post("usergroup_title"));
        $r= dbh::sql_update("title='$title'", "usergroups", "id=$id");
        
        dbh::sql_delete("map_user_usergroup", "usergroup_id=".$usergroup_id);
        $users=ch::get_post("users");
        foreach ($users as $user){
            dbh::sql_insert("user_id,usergroup_id", "map_user_usergroup", $user[0].",".$usergroup_id);
        }
        
        dbh::close();
        return $r;
    }
    
    static function get_usergroup($usergroup_id){
        dbh::init();
        $id= mysqli_real_escape_string(dbh::$con,$usergroup_id);
        $r=dbh::sql_select("id,title", "usergroups", "id=".$id);
        dbh::close();
        return $r[0];
    }
    
    static function add_user_to_usergroup($usergroup_id,$user_id){
        dbh::init();
        $ug_id= mysqli_real_escape_string(dbh::$con,$usergroup_id);
        $u_id= mysqli_real_escape_string(dbh::$con,$user_id);
        $r=dbh::sql_insert("usergroup_id,user_id", "map_user_usergroup", "$ug_id,$u_id");
        dbh::close();
        return $r;
    }
    
    static function remove_user_from_usergroup($usergroup_id,$user_id){
        dbh::init();
        $ug_id= mysqli_real_escape_string(dbh::$con,$usergroup_id);
        $u_id= mysqli_real_escape_string(dbh::$con,$user_id);
        $r=dbh::sql_delete("map_user_usergroup", "user_id=$u_id and usergroup_id=$ug_id");
        dbh::close();
        return $r;
    }
    
    static function get_users_in_usergroup($usergroup_id){
        dbh::init();
        $sql="select u.id, u.nickname, case when uu.id is null then 0 else 1 end selected from users u left join map_user_usergroup uu on uu.user_id=u.id and uu.usergroup_id=". mysqli_real_escape_string(dbh::$con,$usergroup_id);
        $r= dbh::sql_return($sql);        
        dbh::close();
        return $r;
    }
    
    static function get_all_movies_in_usergroup($usergroup_id){
        dbh::init();
        $sql="select distinct m.id,m.title,m.imdb_link,m.imdb_score from movies m inner join map_user_movie um on um.movie_id=m.id inner join map_user_usergroup uu on uu.user_id=um.user_id where uu.usergroup_id=". mysqli_real_escape_string(dbh::$con,$usergroup_id);
        $r= dbh::sql_return($sql);        
        dbh::close();
        return $r;
    }
    
    static function get_common_movies_in_usergroup($usergroup_id){
        dbh::init();
        $sql="call get_common_usergroup_movies (". mysqli_real_escape_string(dbh::$con,$usergroup_id).")";
        $r= dbh::sql_return($sql);        
        dbh::close();
        return $r;
    }
    
    static function get_usergroup_name($usergroup_id){
        dbh::init();
        $r= dbh::sql_select("title", "usergroups", "id=".mysqli_real_escape_string(dbh::$con,$usergroup_id));
        dbh::close();
        return $r;
    }

}
