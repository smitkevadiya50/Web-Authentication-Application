<?php
// Include the database connection script
include 'db.php';

// Set the content type to JSON for the response
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract username and password from the decoded data
    $username = $data['username'];

    // Hash the password for secure storage
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    try {
        // Prepare an SQL statement for user registration
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");

        // Execute the statement with the username and hashed password
        $stmt->execute(['username' => $username, 'password' => $password]);

        // Start a new session
        session_start();

        // Store the username in the session for tracking the logged-in user
        $_SESSION['username'] = $username;

        // Send a success response in JSON format
        echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
    } catch (PDOException $e) {
        // If an error occurs, send an error response in JSON format
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    // If the request method is not POST, send an error response
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
