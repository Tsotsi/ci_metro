<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends TT_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->load->library('pagination');

$config['base_url'] = 'http://example.com/index.php/test/page/';
$config['total_rows'] = 200;
$config['per_page'] = 20;

$this->pagination->initialize($config);

$v=$this->pagination->create_links();
$this->load->library('table');

$data = array(
        array('Name', 'Color', 'Size'),
        array('Fred', 'Blue', 'Small'),
        array('Mary', 'Red', 'Large'),
        array('John', 'Green', 'Medium')
);

$table=$this->table->generate($data);
$this->load->helper('form');
//$cap=  $this->_getCaptcha();
		$this->load->view('welcome_message',array('v'=>$v,'table'=>$table));
	}
        public function login()
        {
            $this->config->set_item('language','english');
            $this->load->language('common');
            $this->load->language('login');
            $this->seo_set('title', $this->lang->line('login_title'));
            $this->load->helper('form');
            $this->load->helper('language');
            $this->load->view('login');
        }
        private function _createCaptcha()
        {
            $this->load->library('captcha');
            $this->captcha->doimg();
return $this->captcha->getCode();
        }
        public function getCaptcha()
        {
            $captcha_id=$this->_createCaptcha();
        }
}
