<?php

/**
 * Description of Auth_model
 *
 * @author quytech
 */
class Auth_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function insert_user($user){
        $result = $this->db->insert('users', $user);
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function check_user($user){
        $this->db->select('*');
        $result  =$this->db->get_where('users', ['user_name' => $user['user_name'], 'password' => $user['password']])->row_array();
        if($result){
            return $result;
        } else {
            return false;
        }
    }

    public function get_data($table_name)
    {
        $this->db->select('*');
        $result  =$this->db->get($table_name)->result_array();
        if($result){
            return $result;
        } else {
            return false;
        }
    }

}
