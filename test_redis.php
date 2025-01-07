<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Test Redis connection
try {
    // Create a new Redis instance
    $redis = new Redis();

    // Connect to Redis server (use your Redis server details if not localhost:6379)
    $redis->connect('127.0.0.1', 6379);

    // Authenticate if Redis requires a password
    // $redis->auth('your_password'); // Uncomment if your Redis is password-protected

    // Set a test key-value pair in Redis
    $redis->set('test_key', 'Redis is working!');

    // Retrieve the value from Redis
    $value = $redis->get('test_key');

    // Display the result
    echo "Redis Test Successful! Retrieved value: " . $value;

} catch (Exception $e) {
    // Catch and display errors
    echo "Redis Test Failed: " . $e->getMessage();
}
?>
