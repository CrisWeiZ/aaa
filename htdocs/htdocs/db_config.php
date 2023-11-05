<?php

// Database configuration settings
$host = 'localhost';
$username = 'panisa';
$password = '987654';
$database = 'fashionswap';

// database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$connection) {
    die("Error connecting to MySQL server." . mysqli_connect_error());
}
?>