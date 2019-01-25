<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('parser');
	}

	public function render($view, $data = null)
	{		
		if ($data === NULL) {
			$data = array();
		}

		// render views bottom-to-top while layout specified and not equal to default_layout
		do
		{
			// erase previous layout
			$this->viewbag->layout = '';

			// render current view/layout
			$data['CONTENT'] = $this->parser->parse($view, $data, TRUE);

			// determine next layout to render. If $this->viewbag->layout was not specified while last rendering then use default_layout
			$view = !empty($this->viewbag->layout) ? $this->viewbag->layout : config_item('default_layout');

		} while ($view !== config_item('default_layout'));

		$this->parser->parse($view, $data);
	}
	
	public function error()
	{
		$this->render("errors/error");
	}
	
	public function error_403()
	{
		$this->render("errors/error_403");
	}
	
	public function error_404()
	{
		$this->render("errors/error_404");
	}
	
	protected function view_exists($view)
	{
		return !empty($view) && file_exists(VIEWPATH.$view.'.php');
	}
}
