<?php

namespace App\Models;

use CodeIgniter\Model;

class UploadModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'upload';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['file_name','file_ext','upload_path'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
        'file_name' => 'required|ext_in[file,jpg,jpeg,docx,pdf]'
    ];
	protected $validationMessages   = [
	    'file_name' => [
	        'required' => 'Sila Pilih'
        ]
    ];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

    function getajaxupload(){

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

        $datamu=  $this;

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

//            $btn="<a href='".site_url('film/detailrentail')."'>view</a>";
//
//            $btn .= "<a href='".site_url('film-management/edit/'.$row->film_id)."' class='btn btn-info'>Update</a>";
//
//            $btn .= form_open('film-management/delete/'.$row->film_id);
//            $btn .= form_hidden('_method','DELETE');
//            $btn .= form_submit('btn_submit','Delete',['class'=>'btn btn-danger','onclick'=>'return confirm("Are you sure?")']);
//            $btn .= form_close();




            $data[]=array(
                generateBil($start),
                $row->file_name,
                $row->file_ext,
                $row->upload_path,

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

    public function insertUpload($data){
        if($this->save($data)){
            return $this->getInsertID();
        }else{
            return $this->errors();
        }
    }

}
