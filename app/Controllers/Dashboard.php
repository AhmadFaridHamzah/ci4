<?php
namespace App\Controllers;

class Dashboard extends BaseController{

    public function index(){
        // dd(base_url());
        $output['content'] = view('dashboard/dashboard');

        return view('main',$output);
    }

}

?>