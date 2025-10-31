<?php
// Include configuration
require_once 'config.php';

// Check if user is logged in (in a real application)
// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.html');
//     exit();
// }

// Handle form submission
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $organizer = isset($_POST['organizer']) ? trim($_POST['organizer']) : '';
    $department = isset($_POST['department']) ? $_POST['department'] : '';
    $max_attendees = isset($_POST['max_attendees']) ? (int)$_POST['max_attendees'] : 0;
    $event_type = isset($_POST['event_type']) ? $_POST['event_type'] : '';
    
    // Simple validation
    if (empty($title) || empty($description) || empty($date) || empty($location) || empty($organizer)) {
        $message = 'Please fill in all required fields.';
        $messageType = 'error';
    } else {
        // In a real application, you would:
        // 1. Connect to the database
        // 2. Insert the new event into the events table
        // 3. Handle any errors
        // 4. Redirect to the event details page or show success message
        
        // For demonstration, we'll just show a success message
        $message = 'Event created successfully!';
        $messageType = 'success';
        
        // In a real application, you would redirect:
        // header('Location: event-details.php?id=' . $new_event_id);
        // exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event - CampusEvents</title>
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

    <!-- Create Event Content -->
    <main class="container">
        <h1 class="section-title">Create New Event</h1>
        
        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo $messageType; ?>"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <div class="create-event-container">
            <form method="POST" class="create-event-form">
                <div class="form-section">
                    <h2><i class="fas fa-info-circle"></i> Event Information</h2>
                    
                    <div class="form-group">
                        <label for="title">Event Title <span class="required">*</span></label>
                        <input type="text" id="title" name="title" placeholder="Enter event title" required value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description <span class="required">*</span></label>
                        <textarea id="description" name="description" rows="5" placeholder="Enter event description" required><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="event_type">Event Type</label>
                            <select id="event_type" name="event_type">
                                <option value="">Select event type</option>
                                <option value="conference" <?php echo (isset($_POST['event_type']) && $_POST['event_type'] === 'conference') ? 'selected' : ''; ?>>Conference</option>
                                <option value="workshop" <?php echo (isset($_POST['event_type']) && $_POST['event_type'] === 'workshop') ? 'selected' : ''; ?>>Workshop</option>
                                <option value="seminar" <?php echo (isset($_POST['event_type']) && $_POST['event_type'] === 'seminar') ? 'selected' : ''; ?>>Seminar</option>
                                <option value="competition" <?php echo (isset($_POST['event_type']) && $_POST['event_type'] === 'competition') ? 'selected' : ''; ?>>Competition</option>
                                <option value="festival" <?php echo (isset($_POST['event_type']) && $_POST['event_type'] === 'festival') ? 'selected' : ''; ?>>Festival</option>
                                <option value="exhibition" <?php echo (isset($_POST['event_type']) && $_POST['event_type'] === 'exhibition') ? 'selected' : ''; ?>>Exhibition</option>
                                <option value="other" <?php echo (isset($_POST['event_type']) && $_POST['event_type'] === 'other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select id="department" name="department">
                                <option value="">Select department</option>
                                <option value="computer_science" <?php echo (isset($_POST['department']) && $_POST['department'] === 'computer_science') ? 'selected' : ''; ?>>Computer Science</option>
                                <option value="engineering" <?php echo (isset($_POST['department']) && $_POST['department'] === 'engineering') ? 'selected' : ''; ?>>Engineering</option>
                                <option value="business" <?php echo (isset($_POST['department']) && $_POST['department'] === 'business') ? 'selected' : ''; ?>>Business</option>
                                <option value="arts_humanities" <?php echo (isset($_POST['department']) && $_POST['department'] === 'arts_humanities') ? 'selected' : ''; ?>>Arts & Humanities</option>
                                <option value="science" <?php echo (isset($_POST['department']) && $_POST['department'] === 'science') ? 'selected' : ''; ?>>Science</option>
                                <option value="medicine" <?php echo (isset($_POST['department']) && $_POST['department'] === 'medicine') ? 'selected' : ''; ?>>Medicine</option>
                                <option value="law" <?php echo (isset($_POST['department']) && $_POST['department'] === 'law') ? 'selected' : ''; ?>>Law</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h2><i class="fas fa-calendar-alt"></i> Date & Time</h2>
                    
                    <div class="form-group">
                        <label for="date">Event Date & Time <span class="required">*</span></label>
                        <input type="datetime-local" id="date" name="date" required value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-section">
                    <h2><i class="fas fa-map-marker-alt"></i> Location</h2>
                    
                    <div class="form-group">
                        <label for="location">Event Location <span class="required">*</span></label>
                        <input type="text" id="location" name="location" placeholder="Enter event location" required value="<?php echo isset($_POST['location']) ? htmlspecialchars($_POST['location']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-section">
                    <h2><i class="fas fa-user"></i> Organizer Information</h2>
                    
                    <div class="form-group">
                        <label for="organizer">Organizer Name <span class="required">*</span></label>
                        <input type="text" id="organizer" name="organizer" placeholder="Enter organizer name" required value="<?php echo isset($_POST['organizer']) ? htmlspecialchars($_POST['organizer']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="max_attendees">Maximum Attendees</label>
                        <input type="number" id="max_attendees" name="max_attendees" min="1" placeholder="Enter maximum number of attendees" value="<?php echo isset($_POST['max_attendees']) ? (int)$_POST['max_attendees'] : ''; ?>">
                    </div>
                </div>
                
                <div class="form-section">
                    <h2><i class="fas fa-image"></i> Event Image</h2>
                    
                    <div class="form-group">
                        <label for="event_image">Upload Event Image</label>
                        <input type="file" id="event_image" name="event_image" accept="image/*">
                        <p class="form-help">Recommended size: 1200x600 pixels</p>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn primary-btn">Create Event</button>
                    <button type="reset" class="btn secondary-btn">Reset Form</button>
                </div>
            </form>
        </div>
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
                        <li><a href="explore-events.php">Explore Events</a></li>
                        <li><a href="events.php">Manage Events</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 CampusEvents. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Set min date to today for the datetime picker
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().slice(0, 16);
            document.getElementById('date').min = today;
        });
    </script>
</body>
</html>