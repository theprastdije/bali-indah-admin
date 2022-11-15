<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
	public function index()
	{
		//
	}

	public function register()
	{
		$data = [
			'title' => 'Register'
		];
		echo view('auth/register', $data);
	}

	public function login()
	{
		$data = [
			'title' => 'Login'
		];
		echo view('auth/login', $data);
	}
}
