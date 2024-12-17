<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->library('session'); // Load session library for user sessions
        $this->load->database(); // Load database
    }

    public function index() {
        $this->load->view('login');
    }

    // Login method
    public function login() {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            // Check credentials with the User model
            $user = $this->User_model->login($username, $password);
            
            if ($user) {
                $this->session->set_userdata('user', $user); // Set session data
                redirect('dashboard'); // Redirect to dashboard or another page
            } else {
                $this->session->set_flashdata('error', 'Invalid credentials');
                redirect('login'); // Redirect to login page on failure
            }
        } else {
            $this->load->view('login');
        }
    }

    // Register method
    public function register() {
        // Check if the form is submitted
        if ($this->input->post()) {
            // Get user data from the form
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')  // Hashing happens in the model
            );
    
            // Call the register method of the User_model
            $this->User_model->register($data);
    
            // Redirect to login page after successful registration
            redirect('auth/login');
        }
    
        // Load the register view if form is not submitted
        $this->load->view('register');
    }

    // Logout method
    public function logout() {
        $this->session->sess_destroy(); // Destroy session
        redirect('login'); // Redirect to login page after logout
    }
}
