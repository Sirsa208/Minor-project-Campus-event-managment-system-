<?php
// Campus Event Management System - Backend
// This is a simplified version for demonstration purposes

// Database configuration (in a real application, store these in a separate config file)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_events";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get all events
function getAllEvents($conn) {
    $sql = "SELECT * FROM events ORDER BY event_date ASC";
    $result = $conn->query($sql);
    
    $events = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
    return $events;
}

// Function to get a single event by ID
function getEventById($conn, $id) {
    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

// Function to add a new event
function addEvent($conn, $title, $description, $date, $location, $organizer) {
    $sql = "INSERT INTO events (title, description, event_date, location, organizer) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $title, $description, $date, $location, $organizer);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to register a user for an event
function registerForEvent($conn, $user_id, $event_id) {
    $sql = "INSERT INTO event_registrations (user_id, event_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $event_id);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Handle form submissions
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create_event'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $location = $_POST['location'];
        $organizer = $_POST['organizer'];
        
        if (addEvent($conn, $title, $description, $date, $location, $organizer)) {
            $message = "Event created successfully!";
        } else {
            $message = "Error creating event.";
        }
    }
    
    if (isset($_POST['register_event'])) {
        $user_id = $_POST['user_id'];
        $event_id = $_POST['event_id'];
        
        if (registerForEvent($conn, $user_id, $event_id)) {
            $message = "Registration successful!";
        } else {
            $message = "Error registering for event.";
        }
    }
}

// Get all events for display
$events = getAllEvents($conn);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - CampusEvents</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="logo">
                    <h2><i class="fas fa-calendar-alt"></i> CampusEvents</h2>
                </div>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="explore-events.php" class="nav-link">Explore Events</a></li>
                    <li class="nav-item"><a href="events.php" class="nav-link">Manage Events</a></li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
        <h1 class="section-title">Manage Campus Events</h1>
        
        <?php if ($message): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <!-- Create Event Form -->
        <section class="form-section">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2>Create New Event</h2>
                <a href="create-event.php" class="btn primary-btn">Create Event</a>
            </div>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="title">Event Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="date">Date & Time:</label>
                        <input type="datetime-local" id="date" name="date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="organizer">Organizer:</label>
                    <input type="text" id="organizer" name="organizer" required>
                </div>
                
                <button type="submit" name="create_event" class="btn primary-btn">Create Event</button>
            </form>
        </section>
        
        <!-- Events List -->
        <section class="events-list">
            <h2>Current Events</h2>
            <?php if (count($events) > 0): ?>
                <div class="events-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Organizer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($events as $event): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($event['title']); ?></td>
                                    <td><?php echo date('M j, Y g:i A', strtotime($event['event_date'])); ?></td>
                                    <td><?php echo htmlspecialchars($event['location']); ?></td>
                                    <td><?php echo htmlspecialchars($event['organizer']); ?></td>
                                    <td>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                                            <input type="hidden" name="user_id" value="1"> <!-- In a real app, this would be the logged-in user -->
                                            <a href="event-register.php?event_id=<?php echo $event['id']; ?>" class="btn small-btn">Register</a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>No events found. Create your first event above!</p>
            <?php endif; ?>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h3><i class="fas fa-calendar-alt"></i> CampusEvents</h3>
                    <p>Managing campus events made simple</p>
                </div>
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="events.php">Manage Events</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 CampusEvents. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>