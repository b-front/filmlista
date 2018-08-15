<?php

abstract class movie_view{
    static function get_add_movie_form(){
        $x="";
        $x.="<form method='post'>";
        $x.="Filmtitel:<br/>";
        $x.="<input type='text' name='movie_title'/><br/><br/>";
        $x.="L&auml;nk till IMDB:<br/>";
        $x.="<input type='text' name='imdb_link'/><br/><br/>";
        $x.="Betyg hos IMDB:<br/>";
        $x.="<input type='text' name='imdb_score'/><br/><br/>";
        $x.=self::get_categories_dropdown();
        $x.=self::get_actors_dropdown();
        $x.="<input type='submit' value='L&auml;gg till'/>";
        $x.="</form>";
        return $x;
    }
    
    static function show_all_movies(){
        $r=mh::get_all_movies();
        $x="";
        foreach($r as $row){
            $x.="<a href='".$row[2]."' target='_blank'>".$row[1]." (".$row[3].")</a> <a href='/edit_movie?movie_id=".$row[0]."'>Hantera film</a><br/>";
        }
        return $x;
    }
    
    static function get_edit_movie_form(){
        $movie_id=ch::get_get("movie_id");
        $r=mh::get_movie($movie_id);
        $x="";
        $x.="<form method='post'>";
        $x.="Filmtitel:<br/>";
        $x.="<input type='text' name='movie_title' value='".$r[1]."'/><br/><br/>";
        $x.="L&auml;nk till IMDB:<br/>";
        $x.="<input type='text' name='imdb_link' value='".$r[2]."'/><br/><br/>";
        $x.="Betyg hos IMDB:<br/>";
        $x.="<input type='text' name='imdb_score' value='".$r[3]."'/><br/><br/>";
        $x.="<input type='hidden' name='movie_id' value='".$r[0]."'/>";
        $x.=self::get_categories_dropdown($movie_id);
        $x.=self::get_actors_dropdown($movie_id);
        $x.="<input type='submit' value='Uppdatera'/>";
        $x.="</form>";
        return $x;
    }
    
    static function get_categories_dropdown($movie_id=0){
        $x="";
        $x.="<select multiple='multiple' size='5' name='movie_categories[]' style='width:100px'>";
        if($movie_id!=0){
            $c=mh::get_movie_categories($movie_id);
            foreach ($c as $row){
                $x.="<option value='".$row[0]."'";
                if($row[2]==1){
                    $x.=" selected='selected'";
                }
                $x.=">".$row[1]."</option>";
            }
        }
        else{
            $c=category_handler::get_all_categories();
            foreach ($c as $row){
                $x.="<option value='".$row[0]."'>".$row[1]."</option>";
            }
        }
        $x.="</select><br/><br/>";
        return $x;
    }
    
    static function get_actors_dropdown($movie_id=0){
        $x="";
        $x.="<select multiple='multiple' size='5' name='movie_actors[]' style='width:100px'>";
        if($movie_id!=0){
            $a=mh::get_movie_actors($movie_id);
            foreach ($a as $row){
                $x.="<option value='".$row[0]."'";
                if($row[2]==1){
                    $x.=" selected='selected'";
                }
                $x.=">".$row[1]."</option>";
            }
        }
        else{
            $a=actor_handler::get_all_actors();
            foreach ($a as $row){
                $x.="<option value='".$row[0]."'>".$row[1]."</option>";
            }
        }
        $x.="</select><br/><br/>";
        return $x;
    }
    
    static function add_movie_to_user($user_id){
        $r=mh::get_user_movies($user_id);
        $x="";
        $x.="<form action='/add_movie_to_user' method='post'>";
        $x.="<select name='movies_to_user[]' multiple='multiple' size='5' style='width:100px;'>";
        foreach($r as $row){
            $x.="<option value='".$row[0]."'";
            if($row[2]==1){
                $x.=" selected='selected'";
            }
            $x.=">".$row[1]."</option>";
        }
        $x.="</select><br/>";
        $x.="<input type='hidden' name='user_id' value='".$user_id."' />";
        $x.="<input type='submit' value='spara'/>";
        $x.="</form>";
        return $x;
    }
    
    static function get_users_movie_list($user_id){
        $r=mh::get_users_movies($user_id);
        $x="";
        foreach($r as $row){
            $x.="<a href='".$row[2]."' target='_blank'>".$row[1]." (".$row[3].")</a> <br/>";
        }
        return $x;
    }
    
}

