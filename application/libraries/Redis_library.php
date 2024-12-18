<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Ensure Predis is autoloaded
require_once FCPATH . 'vendor/autoload.php';

class Redis_library {
    private $CI;
    private $redis;

    public function __construct() {
        $this->CI = &get_instance();
        $this->CI->config->load('redis');

        try {
            // Create Predis client with configuration
            $this->redis = new Predis\Client([
                'scheme' => 'tcp',
                'host' => $this->CI->config->item('redis_host'),
                'port' => $this->CI->config->item('redis_port'),
                'password' => $this->CI->config->item('redis_password'),
                'database' => $this->CI->config->item('redis_database'),
                'timeout' => $this->CI->config->item('redis_timeout'),
                'read_write_timeout' => $this->CI->config->item('redis_read_timeout')
            ]);

            // Optional: Test connection
            $this->redis->ping();
        } catch (Exception $e) {
            log_message('error', 'Redis Connection Error: ' . $e->getMessage());
            show_error('Unable to connect to Redis: ' . $e->getMessage());
        }
    }

    // Wrapper methods for common Redis operations
    public function set($key, $value, $expiry = null) {
        if ($expiry) {
            return $this->redis->setex($key, $expiry, $value);
        }
        return $this->redis->set($key, $value);
    }

    public function get($key) {
        return $this->redis->get($key);
    }

    public function delete($key) {
        return $this->redis->del($key);
    }

    // Allow access to the raw Predis client if needed
    public function getClient() {
        return $this->redis;
    }
}