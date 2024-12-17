<?php
class Auth_model extends CI_Model {

    public function register_user($data) {
        $this->db->insert('users', $data);
    }

    public function check_user($username) {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row();
    }
}
