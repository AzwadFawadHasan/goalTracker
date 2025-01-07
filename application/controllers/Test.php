<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load any necessary libraries, helpers, etc.
    }

    // Method to handle test_redis.php file
    public function redis_test() {
        // Directly include the test_redis.php file from the root
        include_once FCPATH . 'test_redis.php';
    }
}
