<?php
// Goal_model.php
class Goal_model extends CI_Model {

    // Method to insert a new goal into the database
    public function create_goal($data) {
        return $this->db->insert('goals', $data);  // Insert the goal data
    }

    // Method to get all goals from the database
    public function get_goals() {
        $query = $this->db->get('goals');
        return $query->result();  // Return all goals
    }

    // Method to update a goal
    public function update_goal($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('goals', $data);
    }

    // Method to delete a goal
    public function delete_goal($id) {
        $this->db->where('id', $id);
        return $this->db->delete('goals');
    }
}
