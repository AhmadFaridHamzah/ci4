<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\IncomingRequest;
class RentalModel extends Model
{

    protected $table      = 'rental';
    protected $primaryKey = 'rental_id';



    public function getrental(){

          $data=  $this
          ->select('f.title,c.first_name as customer_name,
          s.first_name as staff_name')
          ->join('inventory i','i.inventory_id=rental.inventory_id')
          ->join('film f','f.film_id=i.film_id')
          ->join('customer c','c.customer_id=rental.customer_id')
          ->join('staff s','s.staff_id=rental.staff_id')
          ->paginate(10);
        //   ->limit(100)
        //   ->find();


       return $data;

    }


    public function getrentaldatatable(){
        $request = service('request');
        $draw = intval($request->getPostGet("draw"));
        $start = intval($request->getPostGet("start"));
        $length = intval($request->getPostGet("length"));


        // dd($_GET);
        // $draw = 1;
        // $start = 2;
        // $length = 3;

        $columnserch=['f.title','c.first_name'];




        $datamu=  $this
        ->select('f.title,c.first_name as customer_name,
        s.first_name as staff_name')
        ->join('inventory i','i.inventory_id=rental.inventory_id')
        ->join('film f','f.film_id=i.film_id')
        ->join('customer c','c.customer_id=rental.customer_id')
        ->join('staff s','s.staff_id=rental.staff_id')
         ->limit($length,$start )
		
       
         ->asObject()->find();
        
        $data = array();

        foreach($datamu as $r) {

             $data[] = array(
               $r->title,
               $r->customer_name,
               $r->staff_name
                
             );
        }

        $output = array(
             "draw" => $draw,
               "recordsTotal" =>  $this->countAll(),
               "recordsFiltered" =>  $this->countAll(),
               "data" => $data
          );
        echo json_encode($output);
        exit();

     return $data;

  }

public function emp_page()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('employees');

		// echo '<pre>';

		// print_r($_GET['columns']);
		// echo '</pre>';
		 // Datatables Variables
		 $draw = intval($this->request->getPostGet("draw"));
          $start = intval($this->request->getPostGet("start"));
          $length = intval($this->request->getPostGet("length"));
		  $length = intval($this->request->getPostGet("length"));

		  $search = ($this->request->getPostGet("search"));
		  $columns = ($this->request->getPostGet("columns"));


	           $serchform[]['first_name'] = ($this->request->getPostGet("first_name"));
	

		  foreach($columns as $row){

			$columnsz[]=$row['name'];


		  }

		  foreach($serchform as $key=>$rowpz){

			if(!empty($rowpz)){
			//	$builder->where($key, $rowpz);
			}

			


		  }

		  $sql = $builder->getCompiledSelect();
echo $sql;


		  if($search['value']){

			foreach($columnsz as $rowp){

				// echo '<pre>';
				//  print_r($rowp);
				//  echo '</pre>';
				// die();

				$builder->orLike($rowp, $search['value'],'both');

		//	$query=	$db->like('title', 'match', 'both');

							// $this->db->where("(s.student_phone LIKE '%" . ($_POST['sSearch']) . "%' OR s.student_name LIKE '%" . ($_POST['sSearch']) . "%' OR s.student_mykad LIKE '%" . ($_POST['sSearch'])
							//  . "%' OR c.course_name LIKE '%" . ($_POST['sSearch']) . "%' OR ls.status_description LIKE '%" . ($_POST['sSearch']) . "%')");

			}

		  }




		//  d($_GET);
		 $Employees=new Employees();

		
			
		 $builder->limit($length,$start );
		
		// if($search['value']){
		// 	$builder->like('title', 'match', 'both'); 
		// }


		 $books = $builder->get();

		

	
		 $data = array();

		 foreach($books->getResult() as $r) {

			  $data[] = array(
				$r->last_name,
				$r->first_name
				 
			  );
		 }

		 $output = array(
			  "draw" => $draw,
				"recordsTotal" => $db->table('employees')->get()->getNumRows(),
				"recordsFiltered" => $db->table('employees')->get()->getNumRows(),
				"data" => $data
		   );
		 echo json_encode($output);
		 exit();
	}



    function getajaxrental(){

        $request = service('request');
        $draw = intval($request->getGet("draw"));
        $start = intval($request->getGet("start"));
        $length = intval($request->getGet("length"));

        $datamu=  $this
        ->select('f.title,c.first_name as customer_name,
        s.first_name as staff_name')
        ->join('inventory i','i.inventory_id=rental.inventory_id')
        ->join('film f','f.film_id=i.film_id')
        ->join('customer c','c.customer_id=rental.customer_id')
        ->join('staff s','s.staff_id=rental.staff_id')
        ->limit($length,$start)
		
       
        ->asObject()->find();

         $data=array();
      
         foreach($datamu as $row){

            $btn="<a href='".site_url('film/detailrentail')."'>view</a>";
         
            $data[]=array(
              generateBil($start),
                $row->title,
                $row->customer_name,
                $row->staff_name,
                $btn

            );

         }


         $output=[

            "draw" => $draw,
               "recordsTotal" =>  $this->countAll(),
               "recordsFiltered" =>  $this->countAll(),
               "data" => $data

         ];

         echo json_encode($output);
         exit();
        



    }

}