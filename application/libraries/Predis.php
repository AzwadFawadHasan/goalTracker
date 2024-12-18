<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'vendor/autoload.php');  // Include Composer's autoloader

require_once(APPPATH.'vendor/autoload.php');  // Include Composer's autoloader
use Predis\Client;


class Predis {

    protected $client;

    public function __construct() {
        $this->client = new Client();  // Default to localhost:6379
    }

    public function set($key, $value) {
        return $this->client->set($key, $value);
    }

    public function get($key) {
        return $this->client->get($key);
    }

    public function delete($key) {
        return $this->client->del([$key]);
    }

    // Add more methods for other Redis operations as needed
}
