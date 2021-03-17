<?php

namespace App\Models;

use CodeIgniter\Model;

class FilmModel extends Model
{

    protected $table      = 'film';
    protected $primaryKey = 'film_id';

    // ...

    public function get_film(){

     
        $film = $this;
        $film->select('film.title,film.release_year,l.name');
        $film->join('language as l','l.language_id=film.language_id','left');
        $film->where('release_year', 2006);
        $film->where('rating', 'R');
        $film->limit(1000);

      //  $data= $film->asObject()->find();
        $data= $film->find();

      return  $data;

    }


}