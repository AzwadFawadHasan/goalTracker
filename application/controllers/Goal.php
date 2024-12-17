<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Ensure database is loaded
    }

    // Create a new goal
    public function create_goal($data) {
        $this->db->insert('goals', $data);  // Insert the data into the 'goals' table
        return $this->db->insert_id();      // Return the ID of the inserted goal
    }

    // Get all goals for the logged-in user
    public function get_goals($user_id) {
        $query = $this->db->get_where('goals', array('user_id' => $user_id));
        return $query->result(); // Return an array of goals
    }

    // Get a specific goal by ID
    public function get_goal($goal_id) {
        $query = $this->db->get_where('goals', array('id' => $goal_id));
        return $query->row(); // Return a single goal object
    }

    // Update a goal
    public function update_goal($goal_id, $data) {
        $this->db->where('id', $goal_id);
        $this->db->update('goals', $data); // Update goal data based on the goal ID
    }

    // Delete a goal
    public function delete_goal($goal_id) {
        $this->db->where('id', $goal_id);
        $this->db->delete('goals'); // Delete the goal from the 'goals' table
    }
}
