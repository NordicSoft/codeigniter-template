<?php
defined('APPPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$code = $this->uri->segment(1);
		if (!empty($code)) {
			
			if ($this->view_exists("home/".$code))	
			{
				return $this->render("home/".$code);
			}

			return $this->error_404();
		}
		
		return $this->render("home/index");
	}

	public function guide()
	{
		// make guide available only in development environment
		if (ENVIRONMENT !== 'development') {
			return $this->error_404();
		}

		$data = array(
			'test_var' => 'Lorem test var variable controller\'s view data',
			'test_arr' => array(
				array('name' => 'Nick Smith', 'email' => 'nick.smith@example.com'),
				array('name' => 'John Adams', 'email' => 'john.adams@example.com'),
			)
		);
		
		$this->viewbag->test = "Lorem test variable from viewbag";

		return $this->render("home/guide", $data);
	}

}
