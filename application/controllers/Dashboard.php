<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session'); // Load the session library
        $this->load->helper('url'); // To help with redirection if needed
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->library('session'); // Load session library for user sessions
        $this->load->database(); // Load database

        // Check if the user is logged in
        if (!$this->session->userdata('user_id')) {
            // Redirect to the login page if not logged in
            redirect('auth/login');
        }
    }

    public function index() {
        // Load the dashboard view if the user is logged in
        $this->load->view('dashboard');
    }
    
}
