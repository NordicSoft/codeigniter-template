<?php
defined('APPPATH') OR exit('No direct script access allowed');

//require_once APPPATH.'core/Controller.php';

class Error extends MY_Controller {

	public function index()
	{
		$this->error();
	}
	
	public function error_403()
	{
		$this->error_403();
	}
	
	public function error_404()
	{
		$this->error_404();
	}
	
}
