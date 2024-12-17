<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    // Constructor to load the database
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the database in the model (optional if already done in the controller)
    }

    // Method to register a new user
    public function register($data) {
        // Hash the password before saving it to the database
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->db->insert('users', $data); // Insert user into the 'users' table
    }

    // Method to check if a user exists by username and password (for login)
    public function login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row(); // Get user data
            // Verify the password
            if (password_verify($password, $user->password)) {
                return $user; // Return the user object if login is successful
            }
        }
        return false; // Return false if no user found or password does not match
    }
}
