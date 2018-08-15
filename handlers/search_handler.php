<?php

abstract class search_handler {

    static function get_search_result($search_type,$phrase) {
        dbh::init();
        $phrase= mysqli_real_escape_string(dbh::$con,$phrase);
        $search_type= mysqli_real_escape_string(dbh::$con,$search_type);
        $r="";
        if ($search_type=='all'){
            $sql="call search_all ('".$phrase."')";
            $r=dbh::sql_return($sql);
        }else if($search_type=='movie'){
            $sql="call search_movies ('".$phrase."')";
            $r=dbh::sql_return($sql);
        }else if($search_type=='actor'){
            $sql="call search_actors ('".$phrase."')";
            $r=dbh::sql_return($sql);
        }else{
            $sql="call search_all ('".$phrase."')";
            $r=dbh::sql_return($sql);          
        }
        dbh::close();
        return $r;
    }

}
