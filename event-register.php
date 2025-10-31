<?php
// Get event ID from URL parameter
$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 1;

// In a real application, you would fetch event details from the database
$event = [
    'id' => $event_id,
    'title' => 'Tech Conference 2025',
    'date' => 'Oct 30, 2025',
    'location' => 'Main Auditorium',
    'time' => '10:00 AM'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event - CampusEvents</title>
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
                    <li class="nav-item"><a href="events.php" class="nav-link">Events</a></li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Registration Form -->
    <main class="container">
        <h1 class="section-title">Event Registration</h1>
        
        <div class="event-preview">
            <div class="event-card">
                <div class="event-image">
                    <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="<?php echo htmlspecialchars($event['title']); ?>">
                </div>
                <div class="event-content">
                    <span class="event-date"><?php echo $event['date']; ?></span>
                    <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                    <div class="event-meta">
                        <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></span>
                        <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($event['time']); ?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="registration-form-container">
            <form id="registrationForm" class="registration-form">
                <h2>Register for this Event</h2>
                
                <div class="form-group">
                    <label for="uid">University ID</label>
                    <input type="text" id="uid" name="uid" placeholder="Enter your University ID" required>
                </div>
                
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>
                
                <div class="form-group">
                    <label for="department">Department</label>
                    <select id="department" name="department" required>
                        <option value="">Select your department</option>
                        <option value="computer_science">Computer Science</option>
                        <option value="engineering">Engineering</option>
                        <option value="business">Business</option>
                        <option value="arts">Arts & Humanities</option>
                        <option value="science">Science</option>
                        <option value="medicine">Medicine</option>
                        <option value="law">Law</option>
                    </select>
                </div>
                
                <button type="submit" class="btn primary-btn auth-btn">Register for Event</button>
            </form>
        </div>
    </main>

    <!-- Registration Success Animation -->
    <div id="successAnimation" class="success-animation">
        <div class="animation-content">
            <div class="checkmark-circle">
                <div class="checkmark"></div>
            </div>
            <h2>Registration Successful!</h2>
            <p>You have been successfully registered for the event.</p>
            <div class="loading-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

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

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show success animation
            document.getElementById('successAnimation').style.display = 'flex';
            
            // Redirect to event details after animation
            setTimeout(function() {
                window.location.href = 'event-details.php?id=' + <?php echo $event_id; ?>;
            }, 3000); // 3 seconds delay
        });
    </script>
</body>
</html>