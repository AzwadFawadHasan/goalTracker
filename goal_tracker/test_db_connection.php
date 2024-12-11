<?php
$mysqli = new mysqli("localhost", "devuser", "devuser", "goal_tracker");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
echo "Connected successfully";
?>
