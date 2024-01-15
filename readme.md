# Web Authentication Application

## Description

This web application provides user authentication features, including login, registration, and logout. It uses a frontend built with HTML, CSS, Bootstrap, Ajax and JavaScript and a backend API in PHP for handling authentication processes.

## Prerequisites
- Web Server (e.g., Apache, Nginx)
- PHP
- MySQL Database

## Cloning and Setup
- Clone or download the project files to your web server's root directory.
- Ensure your web server and PHP are correctly installed and running.

## Database Configuration
- Create a MySQL database for the application.
- Configure your database settings in db.php within the API folder.

## File Structure
- auth.html: The main HTML file for login and registration forms.
- auth.js: JavaScript file for handling API calls related to authentication.
- welcome.html: The welcome page that users see after logging in.
## API Folder
- db.php: Connects to the MySQL database.
- login.php: Handles the login functionality.
- logout.php: Manages user logout.
- register.php: Deals with new user registrations.
- route.php: Manages API routes.

## Running the Application
- Open a web browser and navigate to the URL where your project is hosted (e.g., http://localhost/your_project_folder/auth.html).
- Use auth.html to register a new user or log in.
- After logging in, users will be redirected to welcome.html.
