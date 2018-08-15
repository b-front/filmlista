<?php

abstract class category_view {

    static function get_all_categories() {
        $r= category_handler::get_all_categories();
        $x="";
        foreach($r as $row){
            $x.="<a href='/show_movies_in_category?category_id=".$row[0]."'>".$row[1]."</a>";
            if(user_handler::is_admin($_SESSION['logged_in_user'])){
                $x.=" <a href='/remove_category?category_id=".$row[0]."'>Radera kategori</a>";
            }
            $x.="<br/>";
        }
        return $x;
    }
    
    static function get_add_category_form(){
        $x="";
        $x.="<form method='post'>";
        $x.="Ny kategori:<br/>";
        $x.="<input type='text' name='category_title'/><br/><br/>";
        $x.="<input type='submit' value='L&auml;gg till'/>";
        $x.="</form>";
        return $x;
    }
    
    static function get_movies_in_category($category_id){
        $x="";
        $r= category_handler::get_movies_in_category($category_id);
        foreach ($r as $row){
            $x.="<a href='".$row[2]."' target='_blank'>".$row[1]." (".$row[3].")</a><br/>";
        }
        $x.= "<br/><a href='/show_categories'>Tillbaka till kategorier</a><br/>";
        return $x;
    }

}
