<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model(['Auth_model']);
	}
	
	public function login_view(){
		$this->load->view('login');
	}

	public function register_view(){
		$this->load->view('register');
    }
    
    public function login() {
        
        $this->form_validation->set_rules('user_name', 'User Name', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]');
        if ($this->form_validation->run() == TRUE){
            $user = array(
                'user_name'  => $this->input->post('user_name'),
                'password'   => $this->input->post('password')
            );
            $user_result = $this->Auth_model->check_user($user);
            if($user_result != false){
                $newdata = array(
                    'first_name'  => $user_result['first_name'],
                    'username'  => $user_result['user_name'],
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                return redirect('home');
            }else{
                $this->load->view('login');
            }
            
        }else{
            $this->load->view('login');
        }
    }

    public function register() {
        $this->form_validation->set_rules('user_name', 'User Name', 'required|valid_email|is_unique[users.user_name]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('confirm_password', 'Cinfirm Password', 'required|min_length[5]|max_length[12]|matches[password]');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[15]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[15]');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('city_name', 'City Name', 'required|max_length[50]');
        $this->form_validation->set_rules('zip', 'Zip', 'required|min_length[6]|max_length[6]');
        if ($this->form_validation->run() == TRUE){
            $user = array(
                'user_name'  => $this->input->post('user_name'),
                'password'   => $this->input->post('password'),
                'first_name'  => $this->input->post('first_name'),
                'last_name'   => $this->input->post('last_name'),
                'mobile_no'  => $this->input->post('mobile_no'),
                'city_name'  => $this->input->post('city_name'),
                'zip'   => $this->input->post('zip')
            );
            $user_result = $this->Auth_model->insert_user($user);
            if($user_result != false){
                $newdata = array(
                    'username'  => $this->input->post('user_name'),
                    'first_name'  => $this->input->post('first_name'),
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                return redirect('home');
            }else{
                $this->load->view('login');
            }
        }else{
            $this->load->view('register');
        }
    }

    public function home(){
        if($this->session->userdata('logged_in') == TRUE){
            $table_name = 'images';
            $image_result = $this->Auth_model->get_data($table_name);
            if($image_result){
                $data = array('data'=>$image_result);
                $this->load->view('dashboard', $data);
            } else {
                $this->load->view('dashboard', []);
            }
            
        } else {
            $this->load->view('login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        $this->load->view('login');
    }

}
