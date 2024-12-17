<?php
// Goal.php (Controller)

class Goal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Goal_model');
    }

    public function add() {
        if ($this->input->post()) {
            $data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'user_id' => $this->session->userdata('user_id'), // assuming user_id is saved in session
            );
            $this->Goal_model->create_goal($data);
            redirect('goal/list');  // Redirect to the goal list after adding
        }
        $this->load->view('goal_add');  // Load the add goal form
    }
 
    public function list() {
        $data['goals'] = $this->Goal_model->get_goals();  // Fetch all goals
        $this->load->view('goal_list', $data);  // Pass the goals to the view
    }
    
    public function edit($id) {
        $goal = $this->Goal_model->get_goal($id);  // Fetch goal by ID
        $data['goal'] = $goal;
        $this->load->view('goal_edit', $data);  // Pass the goal to the edit view
    }

    public function update($id) {
        if ($this->input->post()) {
            $data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
            );
            $this->Goal_model->update_goal($id, $data);  // Update the goal
            redirect('goal/list');  // Redirect after update
        }
    }
    
    public function delete($id) {
        $this->Goal_model->delete_goal($id);  // Delete goal by ID
        redirect('goal/list');  // Redirect to the goal list after deletion
    }



}
