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
        $output['content'] = view('film-management/create',$data);
        return view('main',$output);
    }
}

?>