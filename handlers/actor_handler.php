<?php

abstract class actor_handler {

    static function get_all_actors() {
        $r=dbh::sql_select("id,name", "actors", "1=1");
        return $r;
    }
    
    static function add_actor(){
        dbh::init();
        $name=mysqli_real_escape_string(dbh::$con,ch::get_post("actor_name"));
        $r=dbh::sql_insert("name", "actors", "'$name'");
        dbh::close();
        return $r;
    }
    
    static function get_actor($actor_id){
        $r=dbh::sql_select("id,name", "actors", "id=".$actor_id);
        return $r[0];
    }
    
    static function update_actor($actor_id){
        dbh::init();
        $name=mysqli_real_escape_string(dbh::$con,ch::get_post("actor_name"));
        $r=dbh::sql_update("name='$name'", "actors", "id=$actor_id");
        dbh::close();
        return $r;
    }
    
    static function delete_actor($actor_id){
        $r= dbh::sql_delete("actors", "id=".$actor_id);
        return $r;
    }
    
    static function get_movies_for_actor($actor_id){
        dbh::init();
        $sql="select m.id,m.title,m.imdb_link,m.imdb_score from map_actor_movie a inner join movies m on m.id=a.movie_id and a.actor_id=".mysqli_real_escape_string(dbh::$con, $actor_id);
        $r=dbh::sql_return($sql);
        dbh::close();
        return $r;
    }

}
