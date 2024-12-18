<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Session extends CI_Session_driver {

    protected $redis;

    public function __construct($params = []) {
        parent::__construct($params);

        // Load the Redis library
        $this->CI = &get_instance();
        $this->CI->load->library('redis_library');

        // Use Redis client from the Redis library
        $this->redis = $this->CI->redis_library->getClient();
    }

    public function open($save_path, $name) {
        // Redis does not require explicit "open"
        return TRUE;
    }

    public function close() {
        // Redis does not require explicit "close"
        return TRUE;
    }

    public function read($session_id) {
        // Read session data from Redis
        $data = $this->redis->get($session_id);
        return $data ? (string) $data : ''; // Redis returns NULL if the key does not exist
    }

    public function write($session_id, $session_data) {
        // Write session data to Redis with expiration
        $this->redis->set($session_id, $session_data, $this->_config['sess_expiration']);
        return TRUE;
    }

    public function destroy($session_id) {
        // Remove session data from Redis
        $this->redis->del([$session_id]);
        return TRUE;
    }

    public function gc($maxlifetime) {
        // Redis automatically handles garbage collection
        return TRUE;
    }
}
