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
        $data['validation'] = session('validation');

        $output['content'] = view('film-management/create',$data);
        return view('main',$output);
    }

    public function store(){
        if($this->request->getMethod() === 'post'){
            // dd($this->request->getPost());
            //$this->request->getPost() -> $_POST

            $films = new FilmModel();

            $validation = $films->createFilms($this->request->getPost());

            if(is_int($validation)){
                //berjaya

                session()->setFlashdata('message','Added Succesfully');
                session()->setFlashdata('alert-class','alert-success');

                return redirect()->route('film-management');

            }else{
                //x berjaya
                $errors = $validation;

                return redirect()->route('film-management/create')->withInput()->with('validation',$errors);
            }

            // dd($validation);
        }
    }

    public function edit($id){

        $model = new FilmModel();
        $film = $model->find($id);

        $data['language'] = get_language();
        $data['rating'] = get_rating();
        $data['validation'] = session('validation');
        $data['film'] = $film;

        $output['content'] = view('film-management/edit',$data);
        return view('main',$output);
    }

    public function update($id){
        if($this->request->getMethod() === 'post'){
            // dd($this->request->getPost());
            //$this->request->getPost() -> $_POST

            $films = new FilmModel();

            $validation = $films->updateFilms($this->request->getPost());

            if(is_int($validation)){
                //berjaya

                session()->setFlashdata('message','Update Succesfully');
                session()->setFlashdata('alert-class','alert-success');

                return redirect()->route('film-management');

            }else{
                //x berjaya
                $errors = $validation;

                return redirect()->to('/film-management/edit/'.$id)->withInput()->with('validation',$errors);
            }

            // dd($validation);
        }
    }

    public function delete($id){
        
            // dd($this->request->getPost());
            //$this->request->getPost() -> $_POST

            $films = new FilmModel();

            if($film->find($id)){
                //berjaya
                $film->delete($id);

                session()->setFlashdata('message','Deleted Succesfully');
                session()->setFlashdata('alert-class','alert-success');

            }else{
                //x berjaya
                session()->setFlashdata('message','Record not found');
                session()->setFlashdata('alert-class','alert-danger');

            }

            return redirect()->route('film-management');


            // dd($validation);
    }
}

?>