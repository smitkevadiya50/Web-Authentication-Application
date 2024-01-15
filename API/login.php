<?php
// Include the database connection script
include 'db.php';

// Set the content type to JSON for the response
header('Content-Type: application/json');

// Enable CORS (Cross-Origin Resource Sharing) headers to allow requests from all origins
header("Access-Control-Allow-Origin: *"); // Allows all origins
header("Access-Control-Allow-Methods: POST"); // Allows only certain methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // Allows certain headers

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON from the request body
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $password = $data['password'];

    try {
        // Prepare an SQL statement to fetch user data by username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        // Check if the user exists and the password matches the hashed password in the database
        if ($user && password_verify($password, $user['password'])) {
            // Start a new session
            session_start();
            // Store the username in the session for tracking the logged-in user
            $_SESSION['username'] = $username;
            // Send a success response in JSON format
            echo json_encode(['status' => 'success', 'message' => 'Login successful']);
        } else {
            // Send an error response if the login is unsuccessful
            echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
        }
    } catch (PDOException $e) {
        // Send an error response if there's a database-related error
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    // Send an error response if the request method is not POST
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
