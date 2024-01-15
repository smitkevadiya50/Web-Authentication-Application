<?php
// Database configuration
$host = 'localhost'; // Your database host
$dbname = 'User'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

try {
    // Create a new PDO (PHP Data Objects) instance for database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Set PDO error mode to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle a database connection error and display an error message
    die("Could not connect to the database $dbname: " . $e->getMessage());
}
?>
