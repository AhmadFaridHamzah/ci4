<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$output['content'] = view('welcome_message');

		return view('main', $output);
	}

	public function hello(){
		echo "Hai Saya $this->name";
	}

	public function message($name = "",$age = ""){
		echo "Nama Saya $name, berumur $age tahun";
	}
}
