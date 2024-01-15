<?php
// Get the current request URI
$request = $_SERVER['REQUEST_URI'];

// Route requests based on the URI
switch ($request) {
    case '/route.php/login':
        // If the URI is '/route.php/login', include the 'login.php' script
        require __DIR__ . '/login.php';
        break;
    case '/route.php/register':
        // If the URI is '/route.php/register', include the 'register.php' script
        require __DIR__ . '/register.php';
        break;
    default:
        // If the URI doesn't match any known routes, set a 404 response code and display a message
        http_response_code(404);
        echo "No Route Available!";
        break;
}
?>
