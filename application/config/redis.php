<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Redis Configuration
|--------------------------------------------------------------------------
|
| Configuration for connecting to Redis using Predis
|
*/

// $config['redis_host'] = '127.0.0.1'; // Redis server host
// $config['redis_port'] = 6379;        // Default Redis port
// $config['redis_password'] = '';       // Set to your Redis password if any
// $config['redis_database'] = 0;        // Redis database number (default is 0)

// // Optional: Connection timeout and read timeout
// $config['redis_timeout'] = 2.5;      // Connection timeout in seconds
// $config['redis_read_timeout'] = 2.5; // Read timeout in seconds




$config['socket_type'] = 'tcp'; //`tcp` or `unix`
$config['socket'] = '/var/run/redis.sock'; // in case of `unix` socket type
$config['host'] = '127.0.0.1';
$config['password'] = NULL;
$config['port'] = 6379;
$config['timeout'] = 0;