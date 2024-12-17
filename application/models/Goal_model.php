<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Create a new goal
    public function create_goal($data) {
        $this->db->insert('goals', $data);
        return $this->db->insert_id();  // Return the ID of the newly created goal
    }

    // Get all goals for a user
    public function get_goals($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('goals');
        return $query->result();  // Return results as an array of goal objects
    }

    // Get a specific goal
    public function get_goal($goal_id) {
        $this->db->where('id', $goal_id);
        $query = $this->db->get('goals');
        return $query->row();  // Return a single goal object
    }

    // Update a goal
    public function update_goal($goal_id, $data) {
        $this->db->where('id', $goal_id);
        $this->db->update('goals', $data);
        return $this->db->affected_rows();  // Return the number of affected rows
    }

    // Delete a goal
    public function delete_goal($goal_id) {
        $this->db->where('id', $goal_id);
        $this->db->delete('goals');
        return $this->db->affected_rows();  // Return the number of affected rows
    }
}
