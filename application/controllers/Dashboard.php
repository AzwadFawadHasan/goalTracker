<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session'); // Load the session library
        $this->load->helper('url'); // To help with redirection if needed
        $this->load->model('Goal_model'); // Load the Goal model
        $this->load->database(); // Load database

        // Check if the user is logged in
        if (!$this->session->userdata('user_id')) {
            // Redirect to the login page if not logged in
            redirect('auth/login');
        }
    }

    // public function index() {
    //     $user_id = $this->session->userdata('user_id');
    //     // Fetch all goals for the logged-in user
    //     $data['goals'] = $this->Goal_model->get_goals($user_id);
    //     // Load the dashboard view with the goals
    //     $this->load->view('dashboard', $data);
    // }

    public function index() {
        $user_id = $this->session->userdata('user_id');
    
        // Load Redis cache driver
        $this->load->driver('cache', array('adapter' => 'redis')); 
    
        $cache_key = 'user_goals_' . $user_id;
        $goals = $this->cache->get($cache_key); // Try to get goals from Redis cache
    
        if ($goals) {
            // Data loaded from Redis cache
            echo "Goals loaded from Redis. Cache Key: " . $cache_key . "<br>"; // Show the cache key
        } else {
            // Data not found in Redis, fetch from the database
            echo "Goals loaded from MySQL<br>";
            $goals = $this->Goal_model->get_goals($user_id);
            
            // Store the goals data in Redis with an expiration time of 1 hour (3600 seconds)
            $this->cache->save($cache_key, $goals, 3600);
        }
    
        // Load the dashboard view with the goals
        $data['goals'] = $goals;
        $this->load->view('dashboard', $data);
    }
    

    // Create a new goal
    public function create_goal() {
        if ($this->input->post()) {
            $user_id = $this->session->userdata('user_id');
            $data = array(
                'user_id' => $user_id,
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'status' => 'pending' // Default status
            );
            $this->Goal_model->create_goal($data);
            redirect('dashboard');  // Redirect back to the dashboard
        }

        // If the form is not submitted, load the create goal page
        $this->load->view('create_goal');
    }

    // Edit an existing goal
    public function edit_goal($goal_id) {
        // Fetch the goal details
        $goal = $this->Goal_model->get_goal($goal_id);
        if ($goal) {
            $this->load->view('edit_goal', ['goal' => $goal]);
        } else {
            show_404();
        }
    }

    // Update goal details
    public function update_goal($goal_id) {
        if ($this->input->post()) {
            $data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'status' => $this->input->post('status')
            );
            $this->Goal_model->update_goal($goal_id, $data);
            redirect('dashboard');  // Redirect back to the dashboard
        }
    }

    // Delete a goal
    public function delete_goal($goal_id) {
        $this->Goal_model->delete_goal($goal_id);
        redirect('dashboard');  // Redirect back to the dashboard
    }
}
