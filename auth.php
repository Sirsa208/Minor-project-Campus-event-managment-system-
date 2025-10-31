<?php
// Authentication handler for CampusEvents

// Include configuration
require_once 'config.php';

// Function to authenticate user
function authenticateUser($email, $password) {
    // In a real application, you would:
    // 1. Connect to the database
    // 2. Retrieve the user record by email
    // 3. Verify the password using password_verify()
    // 4. Return user data if authentication is successful
    
    // For demonstration purposes, we'll simulate a successful login
    // with a sample user
    
    // Sample user data (in a real app, this would come from the database)
    $user = [
        'id' => 1,
        'username' => 'johndoe',
        'email' => 'john@example.com',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'role' => 'student'
    ];
    
    // Simulate password verification
    // In reality: if (password_verify($password, $hashedPasswordFromDB)) {
    if ($email === 'john@example.com' && $password === 'password123') {
        return $user;
    }
    
    return false;
}

// Function to register a new user
function registerUser($first_name, $last_name, $email, $username, $password, $role) {
    // In a real application, you would:
    // 1. Validate input data
    // 2. Check if email/username already exists
    // 3. Hash the password using password_hash()
    // 4. Insert the new user into the database
    // 5. Return success/failure
    
    // For demonstration, we'll simulate successful registration
    return true;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    
    $user = authenticateUser($email, $password);
    
    if ($user) {
        // Start session and store user data
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['role'] = $user['role'];
        
        // Redirect to dashboard
        setFlashMessage('Login successful! Welcome back, ' . $user['first_name'] . '!', 'success');
        redirect('dashboard.php');
    } else {
        setFlashMessage('Invalid email or password. Please try again.', 'error');
        redirect('login.html');
    }
}

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $first_name = sanitizeInput($_POST['first_name']);
    $last_name = sanitizeInput($_POST['last_name']);
    $email = sanitizeInput($_POST['email']);
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = sanitizeInput($_POST['role']);
    
    // Validate input
    if ($password !== $confirm_password) {
        setFlashMessage('Passwords do not match!', 'error');
        redirect('register.html');
        exit;
    }
    
    // Register the user
    if (registerUser($first_name, $last_name, $email, $username, $password, $role)) {
        setFlashMessage('Registration successful! You can now log in.', 'success');
        redirect('login.html');
    } else {
        setFlashMessage('Registration failed. Please try again.', 'error');
        redirect('register.html');
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_start();
    session_destroy();
    setFlashMessage('You have been logged out successfully.', 'info');
    redirect('index.html');
}
?>