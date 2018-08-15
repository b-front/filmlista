<?php

class search_controller {

    public function init() {
        $x = "";
        
        if (ch::get_action()=='search'){
            $x.= search_view::show_search(ch::get_post("search_type"),ch::get_post("phrase"));
        }
        
        return $x;
    }

}
