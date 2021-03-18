<?php

namespace App\Models;

use CodeIgniter\Model;

class FilmModel extends Model
{

    protected $table      = 'film';
    protected $primaryKey = 'film_id';
    protected $allowedFields = ['title','description','language_id','release_year','rating'];

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

    function getajaxfilm(){

      $request = service('request');
      $draw = intval($request->getGet("draw"));
      $start = intval($request->getGet("start"));
      $length = intval($request->getGet("length"));
      $columns = ($request->getGet("columns"));
      $search = ($request->getGet("search"));
      $order = ($request->getGet("order"));

      // echo '<pre>';
      // print_r($_GET);
      // echo '</pre>';

      $datamu=  $this
      ->select('film.film_id,film.title,film.description,film.release_year,l.name,film.rating')
      ->join('language as l','l.language_id=film.language_id','left');
      

      foreach($columns as $rcol){

        if(!empty($search['value'])){
         
          if(!empty($rcol['name'])){
          $datamu->orLike($rcol['name'],$search['value'],'both');
          }//end of !empty($rcol['name']
       
        }//end of if empty($search['value']
      } //end of foreach columns


      $countresult=$datamu->countAllResults(false);
      // orderby

      if($order[0]['dir']){

        $nocolumn=$order[0]['column'];

        $namecolumn=$columns[$nocolumn]['name'];

        $datamu->orderBy($namecolumn,$order[0]['dir']);


      }
      //end of orderby



      $datamu->limit($length,$start);
  
     
     $datamu2= $datamu->asObject()->find();

       $data=array();
    
       foreach($datamu2 as $row){

          $btn="<a href='".site_url('film/detailrentail')."'>view</a>";
       
          $data[]=array(
            generateBil($start),
              $row->title,
              $row->description,
              $row->release_year,
              $row->name,
              $row->rating,
              $btn

          );

       }


       $output=[

          "draw" => $draw,
             "recordsTotal" =>  $this->countAll(),
             "recordsFiltered" =>   $countresult,
             "data" => $data

       ];

       echo json_encode($output);
       exit();
    
  }

  public function createFilms($data){

    // $data = [
    //   'title' => $data['txt_title'];
    // ];

    if($this->save($data)){
      return $this->getInsertID();
    }else{
      return $this->errors();
    }
  }


}