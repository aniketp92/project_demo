<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// $this->session->mark_as_flash(['error']);
	}

	public function index()
	{
		$this->load->view('login');
	}
}