<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// User_model.php

class Auth extends CI_Controller {

    // Constructor to load required resources
    public function __construct() {
        parent::__construct();
        // Load the session library for user sessions
        $this->load->library('session');
        // Load form validation library
        $this->load->library('form_validation');
        // Load the user model for database interactions
        $this->load->model('User_model');
        // Load the input class for fetching form inputs
        $this->load->helper('url');
    }




    // Verify user credentials during login
    public function verify_user_credentials($email, $password) {
        // Adjust the column names and table as needed
        $this->db->select('id, email, password_hash'); // Ensure these columns exist in your users table
        $this->db->from('users'); // The table where your users are stored
        $this->db->where('email', $email);
        $this->db->where('password_hash', md5($password)); // Assuming you're storing hashed passwords (better use a more secure method than MD5)
        
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row_array(); // Return the user data
        } else {
            return false; // If no match is found
        }
    }

    // Add more methods like registration if needed
}

    // Other methods like register, login, etc.



    // Your methods for registration, login, etc. go here
/*





    // Show the login form
    public function login() {
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }

        $this->load->view('auth/login');
    }

    // Process login
    public function login_process() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->User_model->verify_user_credentials($email, $password);
            if ($user) {
                $this->session->set_userdata('user_id', $user['id']);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid login credentials');
                redirect('auth/login');
            }
        }
    }

    // Show the registration form
    public function register() {
        $this->load->view('auth/register');
    }

    // Process registration
    public function register_process() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/register');
        } else {
            $password_hash = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $user_data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password_hash' => $password_hash
            ];
            $this->User_model->register($user_data);
            $this->session->set_flashdata('success', 'Registration successful. Please log in.');
            redirect('auth/login');
        }
    }

    // Logout user
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}



*/
?>
