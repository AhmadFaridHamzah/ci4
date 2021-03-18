<?php
namespace App\Controllers;

use App\Models\FilmModel;

class FilmManagement extends BaseController{

    public function index(){

        $output['content'] = view('film-management/index');

        return view('main',$output);
    }

    public function ajaxfilmdt(){
        $filmModel = new FilmModel();
        $listfilm = $filmModel->getajaxfilm();

    }

    public function create(){
        $data['language'] = get_language();
        $data['rating'] = get_rating();

        $output['content'] = view('film-management/create',$data);
        return view('main',$output);
    }

    public function store(){
        if($this->request->getMethod() === 'post'){
            // dd($this->request->getPost());
            //$this->request->getPost() -> $_POST

            $films = new FilmModel();

            $validation = $films->createFilms($this->request->getPost());

            dd($validation);
        }
    }
}

?>