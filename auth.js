// Import the 'da' locale from the 'date-fns' library
const { da } = require("date-fns/locale");

// Define API endpoints
var BASE_API = 'http://localhost/API/';
var LOGIN_API = BASE_API + 'login.php';
var REGISTER_API = BASE_API + 'register.php';
var LOGOUT_API = BASE_API + 'logout.php';

// Function to get query parameters from the URL
function getQueryParam(param) {
    var queryParams = new URLSearchParams(window.location.search);
    return queryParams.get(param);
}

$(document).ready(function () {
    // Event handler for clicking the "Register" link
    $('#registerLink').on('click', function() {
        $('#loginForm').hide();
        $('#registerForm').show();
        $('#title').text('Registration');
    });

    // Event handler for clicking the "Login" link
    $('#LoginLink').on('click', function() {
        $('#loginForm').show();
        $('#registerForm').hide();
        $('#title').text('Login');
    });

    // Event handler for submitting the registration form
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        var username = $("#regUsername").val();
        var password = $("#regPassword").val();

        // Send registration data to the server using AJAX
        $.ajax({
            url: REGISTER_API,
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify({
                username: username,
                password: password,
                rememberMe: rememberMe // It seems 'rememberMe' is not defined here
            }),
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    window.location.href = "welcome.html";
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("An error occurred. Please try again later.");
            }
        });
    });

    // Event handler for submitting the login form
    $("#loginForm").submit(function (e) {
        e.preventDefault();

        var username = $("#loginUsername").val();
        var password = $("#loginPassword").val();
        var rememberMe = $("#rememberMe").is(":checked");

        // Send login data to the server using AJAX
        $.ajax({
            url: LOGIN_API,
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify({
                username: username,
                password: password,
                rememberMe: rememberMe
            }),
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    window.location.href = "welcome.html?username=" + username;
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("An error occurred. Please try again later.");
            }
        });
    });

    // Event handler for clicking the "Logout" button
    $('#logoutBtn').click(function() {
        // AJAX request to logout
        $.ajax({
            url: LOGOUT_API, 
            type: 'POST',
            success: function(response) {
                if(response.status == "success"){
                    window.location.href = '/login.html';
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle logout error
                console.error("Logout failed:", status, error);
            }
        });
    });

    // Get the 'username' query parameter from the URL and display it
    var username = getQueryParam('username');
    if (username) {
        $('#displayUsername').text(username);
    }
});
