<?php
// Load Composer's autoloader
require_once FCPATH . 'vendor/autoload.php';  // Ensure this points to the correct location

use Predis\Client;

// Create a new Predis client instance
$redis = new Client();

    // Set a key
$this->redis_library->set('my_key', 'my_value', 3600); // Expires in 1 hour

// Get a key
$value = $this->redis_library->get('my_key');
echo "Stored value: " . $value;


// Delete a key
//$this->redis_library->delete('my_key');



?>
