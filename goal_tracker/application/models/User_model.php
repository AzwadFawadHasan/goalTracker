<?php
class User_model extends CI_Model {

    //Register a new user
    public function register($data){
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    //check if alraedy user exists by email or username
    public function get_user_by_email_or_username($email, $username){
        $this->db->where('email', $email);
        $this->db->or_where('username', $username);
        $query = $this->db->get('users');
        return $query->row_array();
    
    }

    //verify user login credentials
    public function verify_user_credentials($email, $password){
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        $user = $query->row_array();
        if($user && password_verify($password, $user['password_hash'])){
            return $user;
        }
        return false;
    }
    //Get user by ID
    public function get_user_by_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row_array();
    }


}

?>