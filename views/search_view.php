<?php

abstract class search_view {

    static function show_search($search_type,$phrase) {
        $x="";
        //$x.= self::show_searchbox()."<br/><br/>";
        $r= search_handler::get_search_result($search_type,$phrase);
        $x.="S&ouml;kresultat f&ouml;r: ".$phrase."<br/><br/>";
        foreach ($r as $row){
            $x.="<a href='".$row[2]."' target='_blank'>".$row[1]." (".$row[3].")</a> <br/>";
        }
        return $x;
    }
    
    static function show_searchbox(){
        $x="";
        $x.="<form name='search' method='post' action='search'>";
        $x.="<input type='text' name='phrase' />";
        $x.=" <select name='search_type'>";
        $x.="<option value='all'>Allt</option>";
        $x.="<option value='movie'>Filmtitel</option>";
        $x.="<option value='actor'>Sk&aring;despelare</option>";
        $x.=" <input type='submit' value='S&ouml;k'/>";
        $x.="</form>";
        return $x;
    }

}
