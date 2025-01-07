<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->library('session'); // Load session library for user sessions
        $this->load->database(); // Load database
        $this->load->driver('cache', array('adapter' => 'redis', 'backup' => 'file')); // Load Redis cache driver
    
    }

    public function index() {
        $this->load->view('login');
    }

    // old Login method
    /*
    public function login() {
        // Check if the form is submitted
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
    
            // Check credentials with the User model
            $user = $this->User_model->login($username, $password);
    
            if ($user) {
                // Set session data if login is successful
                $this->session->set_userdata('logged_in', TRUE);
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('username', $user->username);
    
                // Redirect to the dashboard after successful login
                redirect('dashboard');
            } else {
                // If login fails, show error message
                $this->session->set_flashdata('error', 'Invalid credentials');
                redirect('auth/login');
            }
        }
    
        $this->load->view('login');
    }
    */

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

    public function login() {
        // Check if the form is submitted
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Check if the user data is cached in Redis
            $user = $this->cache->get('user_' . $username);

            if (!$user) {
                // If not cached, fetch user data from the database
                $user = $this->User_model->login($username, $password);

                // Cache user data in Redis if Redis is available
                if ($user) {
                    $this->cache->save('user_' . $username, $user, 3600); // Cache for 1 hour
                    // Debug message for Redis cache
                    echo 'Session loaded from MySQL and cached in Redis.<br>';
                } else {
                    // Debug message if user is not found in MySQL
                    echo 'Invalid credentials.<br>';
                }
            } else {
                // Debug message if session is loaded from Redis
                echo 'Session loaded from Redis.<br>';
            }

            if ($user) {
                $this->session->set_userdata('logged_in', TRUE);
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('username', $user->username);

                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid credentials');
                redirect('auth/login');
            }
        }

        $this->load->view('login');
    }

    public function logout() {
        // Destroy session data
        $this->session->sess_destroy();

        // Invalidate cached session data in Redis
        $this->cache->delete('user_' . $this->session->userdata('username'));

        redirect('auth/login');
    }

    
}
