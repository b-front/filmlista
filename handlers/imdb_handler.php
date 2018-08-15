<?php

abstract class imdb_handler {

    static function get_movie_by_title($title) {
        $imdb = new IMDbapi(config::get_imdb_credentials());
        $data = $imdb->title($title,'json');
    }

}
