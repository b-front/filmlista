<?php

abstract class category_handler {

    static function get_all_categories() {
        $r= dbh::sql_select("id,name", "categories", "1=1","name");
        return $r;
    }
    
    static function add_category(){
        dbh::init();
        $title=mysqli_real_escape_string(dbh::$con,ch::get_post("category_title"));
        $r=dbh::sql_insert("name", "categories", "'$title'");
        dbh::close();
        return $r;
    }
    
    static function remove_category($category_id){
        dbh::init();
        $id=mysqli_real_escape_string(dbh::$con,$category_id);
        $r=dbh::sql_delete("categories", "id=".$id);
        dbh::close();
        return $r;
    }
    
    static function get_movies_in_category($category_id){
        dbh::init();
        $sql="select m.id,m.title,m.imdb_link,m.imdb_score from map_category_movie cm inner join movies m on m.id=cm.movie_id and cm.category_id=".mysqli_real_escape_string(dbh::$con, $category_id);
        $r=dbh::sql_return($sql);
        dbh::close();
        return $r;
    }

}
