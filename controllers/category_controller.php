<?php

class category_controller{
    public function init(){
        $x="";
        
        if (ch::get_action()=='categories'){
            $x.= category_view::get_all_categories();
        }
            
        if (ch::get_action()=='show_categories'){
            $x.= category_view::get_all_categories();
        }
        
        if (ch::get_action()=='add_category'){
            if(ch::verify_post("category_title")){
                $r= category_handler::add_category();
                if($r){
                    $x.='Kategori tillagd!<br/><br/>';
                }else{
                    $x.='Misslyckades att l&auml;gga till kategori!<br/><br/>';
                }
            }
            $x.=category_view::get_add_category_form();
        }
        
        if (ch::get_action()=='remove_category'){
            $r=category_handler::remove_category(ch::get_get("category_id"));
            if($r){
                $x.='Kategori borttagen!<br/><br/>';
            }else{
                $x.='Misslyckades att ta bort kategori!<br/><br/>';
            }
        }
        
        if (ch::get_action()=='show_movies_in_category'){
            $x.= category_view::get_movies_in_category(ch::get_get("category_id"));
        }
        
        return $x;
    }
}

