<?php namespace App\Controllers;

class Home extends BaseController {
	public function index()	{
		$sesión = session();
    	
    	if ($sesión->has("id_usuario_ses")) {
	        echo view("header");
			echo view("content");
			echo view("footer");
    	} else {
			return view("login");
    	}
	}

	public function principal() {
		$sesión = session();
    	
    	if ($sesión->has("id_usuario_ses")) {
	        echo view("header");
			echo view("content");
			echo view("footer");
    	} else {
			return view("login");
    	}
	}
}
