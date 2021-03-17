<?php

namespace App\Controllers;
use App\Models\FilmModel;
use App\Models\RentalModel;

class Film extends BaseController
{


    public function index(){


        $filmModel= new FilmModel();
        $rentalModel= new RentalModel();

         $data=$filmModel->get_film();

         $datarental=$rentalModel->getrental();




       

    }



    public function rental(){


        $rentalModel= new RentalModel();
        $datarental=$rentalModel->getrental();


        $data['list_data']=$datarental;
        $data['pagination_link']=$rentalModel->pager;

        $per_page=10;

        $page=($this->request->getGet('page')) ? $this->request->getGet('page'):0;
        $data['start']=($page==0 ? 1:(($page-1) * $per_page+1));

        // https://github.com/sukor/test/issues/2

        $output['content'] = view('rental',$data);

        return view('main',$output);


        // https://github.com/sukor/test/issues
       

    }


    public function rentaldatatable(){

        $data['title']='datatable';
        $output['content'] = view('rentaldatatable',$data);

        return view('main',$output);

    }

    public function ajaxrental(){


        $rentalModel= new RentalModel();
        $datarental=$rentalModel->getajaxrental();


    }



    public function rentalview(){
        // $rentalModel= new RentalModel();
        // $rentalModel->getrentaldatatable();

        

        $output['content'] = view('rental');

        return view('main',$output);

    }


    public function datarental(){

        $rentalModel= new RentalModel();
        $rentalModel->getrentaldatatable();

        


    }


    public function detailrentail(){

        $datasession=['keepsearch'=>1];
        
        $this->session->set($datasession);

        $output['content'] = view('detailrentail');

        return view('main',$output);


    }


}