<?php
abstract class dbh{
    public static $con = null;
    
    static function init(){
        if (self::$con==null){
            self::$con=mysqli_connect(config::get_db_host(), config::get_db_user(), config::get_db_pass());
            mysqli_select_db(self::$con,config::get_db());
        }
    }
    
    static function close(){
        if(self::$con != null){
            mysqli_close(self::$con);
            self::$con=null;
        }
    }
    
    static function sql_return($sql){
        self::init();
        $r = array();
        $rs = mysqli_query(self::$con,$sql);
        if ($rs==false){
            $r=0;
        }
        else{
            while ($row = mysqli_fetch_array($rs)) {
                array_push($r, $row);
            }
        }
        self::close();
        return $r;
    }
    
    static function sql_execute($sql){
        self::init();
        $r=mysqli_query(self::$con,$sql);
        self::close();
        return $r;
    }
    
    static function sql_execute_return_id($sql){
        self::init();
        $r=mysqli_query(self::$con,$sql);
        $id= mysqli_insert_id(self::$con);
        self::close();
        return $id;
    }
    
    static function sql_select($columns,$table,$where,$order="1"){
        $sql="select $columns from $table where $where order by $order";
        $r=self::sql_return($sql);
        return $r;
    }
    
    static function sql_update($column_value,$table,$where){
        $sql="update $table set $column_value where $where";
        $r=self::sql_execute($sql);
        return $r;
    }
    
    static function sql_insert($columns,$table,$values){
        $sql="insert into $table ($columns) values ($values)";
        $r=self::sql_execute($sql);
        return $r;
    }
    
    static function sql_insert_get_id($columns,$table,$values){
        $sql="insert into $table ($columns) values ($values)";
        $r=self::sql_execute_return_id($sql);
        return $r;
    }
    
    static function sql_delete($table,$where){
        $sql="delete from $table where $where";
        $r=self::sql_execute($sql);
        return $r;
    }
    
}
