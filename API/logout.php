<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // User is logged in, so clear the session
    $_SESSION = array(); // Clear the session variables

    // If it's desired to kill the session, also delete the session cookie.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();

    // Send a success response
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'message' => 'Logout successful']);
} else {
    // User is not logged in
    header('Content-Type: application/json');
    http_response_code(401); // Unauthorized status code
    echo json_encode(['status' => 'error', 'message' => 'No user is currently logged in']);
}

?>
