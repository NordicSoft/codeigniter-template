
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

	protected $_ci;

	public function __construct()
	{
		parent::__construct();

		$this->_ci =& get_instance();

		$this->_ci->load->library('parser');
		$this->_ci->load->library('viewbag');
	}
	
	public function render_error_view($view, $data = NULL)
	{		
		if ($data === NULL) {
			$data = array();
		}

		// render views bottom-to-top while layout specified and not equal to default_layout
		do
		{
			// erase previous layout
			$this->_ci->viewbag->layout = '';

			// render current view/layout
			$data['CONTENT'] = $this->_ci->parser->parse($view, $data, TRUE);

			// determine next layout to render. If $this->viewbag->layout was not specified while last rendering then use default_layout
			$view = !empty($this->_ci->viewbag->layout) ? $this->_ci->viewbag->layout : config_item('default_layout');

		} while ($view !== config_item('default_layout'));

		return $this->_ci->parser->parse($view, $data, TRUE);
	}

	public function show_404($page = '', $log_error = TRUE)
	{
		if (is_cli())
		{
			return parent::show_404($page, $log_error);
		}
		
		set_status_header(404);
		echo $this->render_error_view('errors/error_404');
		exit(0);	
	}

	public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
	{
		if (is_cli() || ENVIRONMENT === 'development')
		{
			return parent::show_error($heading, $message, $template, $status_code);
		}
				
		set_status_header(status_code);
		echo $this->render_error_view('errors/error');
		exit(0);
	}

	public function show_exception($exception)
	{
		if (is_cli() || ENVIRONMENT === 'development')
		{
			return parent::show_exception($exception);
		}
				
		set_status_header(500);
		echo $this->render_error_view('errors/error');
		exit(0);
	}

	public function show_php_error($severity, $message, $filepath, $line)
	{
		if (is_cli() || ENVIRONMENT === 'development')
		{
			return parent::show_php_error($severity, $message, $filepath, $line);
		}
				
		set_status_header(500);
		echo $this->render_error_view('errors/error');
		exit(0);
	}
}
