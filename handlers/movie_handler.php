<?php

abstract class mh{
    static function add_movie(){
        dbh::init();
        $title=mysqli_real_escape_string(dbh::$con,ch::get_post("movie_title"));
        $link=mysqli_real_escape_string(dbh::$con,ch::get_post("imdb_link"));
        $score=mysqli_real_escape_string(dbh::$con,ch::get_post("imdb_score"));
        $movie_id=dbh::sql_insert_get_id("title,imdb_link,imdb_score", "movies", "'$title','$link',$score");
        
        $categories=ch::get_post("movie_categories");
        foreach ($categories as $row){
            dbh::sql_insert("category_id,movie_id", "map_category_movie", $row.",".$movie_id);
        }
        
        $actors=ch::get_post("movie_actors");
        foreach ($actors as $row){
            dbh::sql_insert("actor_id,movie_id", "map_actor_movie", $row.",".$movie_id);
        }
        
        dbh::close();
        return $movie_id;
    }
    
    static function get_all_movies(){
        $r=dbh::sql_select("id,title,imdb_link,imdb_score", "movies", "1=1","title");
        return $r;
    }
    
    static function get_movie($movie_id){
        $r=dbh::sql_select("id,title,imdb_link,imdb_score", "movies", "id=".$movie_id);
        return $r[0];
    }
    
    static function update_movie($movie_id){
        dbh::init();
        $title=mysqli_real_escape_string(dbh::$con,ch::get_post("movie_title"));
        $link=mysqli_real_escape_string(dbh::$con,ch::get_post("imdb_link"));
        $score=mysqli_real_escape_string(dbh::$con,ch::get_post("imdb_score"));
        $r=dbh::sql_update("title='$title', imdb_link='$link', imdb_score=$score", "movies", "id=$movie_id");
        
        $categories=ch::get_post("movie_categories");
        dbh::sql_delete("map_category_movie", "movie_id=".$movie_id);
        foreach ($categories as $row){
            dbh::sql_insert("category_id,movie_id", "map_category_movie", $row.",".$movie_id);
        }
        
        $actors=ch::get_post("movie_actors");
        dbh::sql_delete("map_actor_movie", "movie_id=".$movie_id);
        foreach ($actors as $row){
            dbh::sql_insert("actor_id,movie_id", "map_actor_movie", $row.",".$movie_id);
        }
        
        dbh::close();
        return $r;
    }
    
    static function get_movie_categories($movie_id){
        dbh::init();
        $sql="select c.id,c.name ,case when cm.id is null then 0 else 1 end selected from categories c left join map_category_movie cm on cm.category_id=c.id and cm.movie_id=".mysqli_real_escape_string(dbh::$con,$movie_id)." order by c.name";
        $r=dbh::sql_return($sql);      
        dbh::close();
        return $r;
    }
    
    static function get_movie_actors($movie_id){
        dbh::init();
        $sql="select a.id,a.name ,case when am.id is null then 0 else 1 end selected from actors a left join map_actor_movie am on am.actor_id=a.id and am.movie_id=".mysqli_real_escape_string(dbh::$con,$movie_id)." order by a.name";
        $r=dbh::sql_return($sql);      
        dbh::close();
        return $r;
    }
    
    static function get_user_movies($user_id){
        dbh::init();
        $sql="select m.id,m.title,case when um.id is null then 0 else 1 end selected from movies m left join map_user_movie um on um.movie_id=m.id and um.user_id=".mysqli_real_escape_string(dbh::$con,$user_id)." order by m.title";
        $r=dbh::sql_return($sql);      
        dbh::close();
        return $r;
    }
    
    static function add_movie_to_user($user_id){
        dbh::init();
        
        dbh::sql_delete("map_user_movie", "user_id=".$user_id);
        $r=false;
        $movies=ch::get_post("movies_to_user");
        foreach ($movies as $movie){
            $r=dbh::sql_insert("user_id,movie_id,want_to_see", "map_user_movie", $user_id.",".$movie[0].",1");
        }
        
        dbh::close();
        return $r;
    }
    
    static function get_users_movies($user_id){
        dbh::init();
        $sql="select m.id, m.title, m.imdb_link, m.imdb_score from movies m inner join map_user_movie um on um.movie_id=m.id and um.user_id=".mysqli_real_escape_string(dbh::$con,$user_id)." order by m.title";
        $r=dbh::sql_return($sql);
        dbh::close();
        return $r;
    }
    
}
