<?php

namespace App\Controllers;

class Test extends BaseController
{


public function testdata(){

    $db = \Config\Database::connect();

  $data=  $db->query('SELECT * FROM `actor`')->getRow();

    dd($data);



}


public function testdata2(){

    // $db = \Config\Database::connect();
    $builder =	$this->db->table('payment');
    $builder->selectMax('amount');

//     $sql = $builder->getCompiledSelect();

//     // trace();
// echo $sql;
// die();
    $query   = $builder->get();
   $data= $query->getResult();

   dd( $data);


}






}