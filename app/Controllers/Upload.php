<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UploadModel;

class Upload extends BaseController
{
    public function index(){

        $output['content'] = view('upload/index');
        return view('main',$output);
    }

    public function ajaxuploaddt(){
        $upload = new UploadModel();
        $listupload = $upload->getajaxupload();
    }

    public function create(){
        $data['validation'] = session('validation');

        $output['content'] = view('upload/create',$data);
        return view('main',$output);
    }

    public function store(){
//        dd($file->getExtension());
        if($this->request->getFiles()){

            $file = $this->request->getFile('file_name');
            $path = 'public/uploads';

            $data = [
                'file_name' => $file->getName(),
                'file_ext' => $file->getExtension(),
                'upload_path' => 'public/uploads/'.$file->getName(),
            ];

            $modelUpload = new UploadModel();
            $validation = $modelUpload->insertUpload($data);

            if(is_int($validation)){
                //berjaya

                if ($file->isValid() && ! $file->hasMoved())
                {
                    $file->move($path);
                }

                session()->setFlashdata('message','Added Succesfully');
                session()->setFlashdata('alert-class','alert-success');

                return redirect()->to('/upload');

            }else{
                //x berjaya
                $errors = $validation;

                return redirect()->to('/upload/create')->withInput()->with('validation',$errors);
            }

        }
    }
}
