<?php
// Configuration file for Campus Event Management System

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'campus_events');

// Site configuration
define('SITE_NAME', 'CampusEvents');
define('SITE_URL', 'http://localhost/campus-event-manager');

// Timezone configuration
date_default_timezone_set('America/New_York');

// Function to establish database connection
function getDBConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to redirect to a specific page
function redirect($url) {
    header("Location: " . $url);
    exit();
}

// Function to display flash messages
function setFlashMessage($message, $type = 'info') {
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
}

function displayFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        $type = isset($_SESSION['flash_type']) ? $_SESSION['flash_type'] : 'info';
        
        echo "<div class='alert alert-{$type}'>{$message}</div>";
        
        // Clear the message
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
    }
}

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>