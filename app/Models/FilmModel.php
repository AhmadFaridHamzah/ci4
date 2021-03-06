<?php

namespace App\Models;

use CodeIgniter\Model;

class FilmModel extends Model
{

    protected $table      = 'film';
    protected $primaryKey = 'film_id';
    protected $allowedFields = ['title','description','language_id','release_year','rating'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
    // ...

    protected $validationRules = [
        'title'=>'required|max_length[50]',
        'description' => 'required',
        'release_year'=> 'required'
    ];

    protected $validationMessages = [
        'title' =>[
          'required' => 'Wajib di isi'
        ],
        'description' =>[
          'required' => 'Wajib di isi'
        ],

    ];

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
      ->select('film.film_id,film.title,film.description,film.release_year,l.name language_name,film.rating')
      ->join('language as l','l.language_id=film.language_id','left');
     

      if(!empty($search['value'])){
      $datamu->orGroupStart();
      foreach($columns as $rcol){

        if(!empty($search['value'])){
         
          if(!empty($rcol['name'])){
         
          $datamu->orLike($rcol['name'],$search['value'],'both');
          }//end of !empty($rcol['name']
       
        }//end of if empty($search['value']
      } //end of foreach columns
      $datamu->groupEnd();
    }


      $countresult=$datamu->countAllResults(false);
      // orderby

      if($order[0]['dir']){

        $nocolumn=$order[0]['column'];

        $namecolumn=$columns[$nocolumn]['name'];

        $datamu->orderBy($namecolumn,$order[0]['dir']);


      }
      //end of orderby

      // $datamu->where(['deleted_at' => NULL]);

//       $sql = $datamu->getCompiledSelect();
// echo $sql;


      $datamu->limit($length,$start);
   //     $sql = $datamu->getCompiledSelect();
// echo $sql;
     
     $datamu2= $datamu->asObject()->find();

       $data=array();
    
       foreach($datamu2 as $row){

          $btn="<a href='".site_url('film/detailrentail')."'>view</a>";

          $btn .= "<a href='".site_url('film-management/edit/'.$row->film_id)."' class='btn btn-info'>Update</a>"; 
       
          $btn .= form_open('film-management/delete/'.$row->film_id);
          $btn .= form_hidden('_method','DELETE');
          $btn .= form_submit('btn_submit','Delete',['class'=>'btn btn-danger','onclick'=>'return confirm("Are you sure?")']);
          $btn .= form_close();




          $data[]=array(
            generateBil($start),
              $row->title,
              $row->description,
              $row->release_year,
              $row->language_name,
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

  public function updateFilms($data){

    // $data['film_id'] = $data['txt_filmid'];

    if($this->save($data)){
      return $this->getInsertID();
    }else{
      return $this->errors();
    }
  }


}