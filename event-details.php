<?php
// In a real application, you would get the event ID from the URL and fetch event details from the database
// $event_id = $_GET['id'];
// $event = getEventById($conn, $event_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details - CampusEvents</title>
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

    <!-- Event Details Content -->
    <main class="container event-details">
        <div class="back-link">
            <a href="events.php" class="btn secondary-btn"><i class="fas fa-arrow-left"></i> Back to Events</a>
        </div>
        
        <div class="event-detail-card">
            <div class="event-detail-image">
                <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" alt="Tech Conference">
            </div>
            
            <div class="event-detail-content">
                <span class="event-date">Oct 30, 2025</span>
                <h1>Tech Conference 2025</h1>
                <p class="event-description">Join us for the biggest tech conference on campus featuring industry experts and workshops. This year's conference will cover the latest trends in artificial intelligence, web development, cybersecurity, and more. Network with professionals and fellow students in the tech field.</p>
                
                <div class="event-info">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>Location</h3>
                            <p>Main Auditorium</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h3>Date & Time</h3>
                            <p>October 30, 2025 | 10:00 AM - 5:00 PM</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-user"></i>
                        <div>
                            <h3>Organizer</h3>
                            <p>Computer Science Department</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-users"></i>
                        <div>
                            <h3>Attendees</h3>
                            <p>142 registered</p>
                        </div>
                    </div>
                </div>
                
                <div class="event-actions">
                    <a href="event-register.php?event_id=1" class="btn primary-btn">Register for Event</a>
                    <button class="btn secondary-btn"><i class="fas fa-calendar-plus"></i> Add to Calendar</button>
                </div>
            </div>
        </div>
        
        <div class="event-section">
            <h2><i class="fas fa-list"></i> Event Schedule</h2>
            <div class="schedule">
                <div class="schedule-item">
                    <div class="schedule-time">10:00 AM</div>
                    <div class="schedule-content">
                        <h3>Registration & Welcome Coffee</h3>
                        <p>Lobby Area</p>
                    </div>
                </div>
                
                <div class="schedule-item">
                    <div class="schedule-time">10:30 AM</div>
                    <div class="schedule-content">
                        <h3>Opening Keynote: Future of AI</h3>
                        <p>Dr. Sarah Johnson, Tech Innovations Inc.</p>
                    </div>
                </div>
                
                <div class="schedule-item">
                    <div class="schedule-time">11:30 AM</div>
                    <div class="schedule-content">
                        <h3>Web Development Workshop</h3>
                        <p>Room 201 - Hands-on session</p>
                    </div>
                </div>
                
                <div class="schedule-item">
                    <div class="schedule-time">1:00 PM</div>
                    <div class="schedule-content">
                        <h3>Lunch Break</h3>
                        <p>Campus Cafeteria</p>
                    </div>
                </div>
                
                <div class="schedule-item">
                    <div class="schedule-time">2:00 PM</div>
                    <div class="schedule-content">
                        <h3>Cybersecurity Panel Discussion</h3>
                        <p>Auditorium - Expert panel</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="event-section">
            <h2><i class="fas fa-comments"></i> Comments</h2>
            <div class="comments">
                <div class="comment-form">
                    <textarea placeholder="Add a comment..." rows="3"></textarea>
                    <button class="btn primary-btn">Post Comment</button>
                </div>
                
                <div class="comment">
                    <div class="comment-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="comment-content">
                        <h4>John Doe</h4>
                        <p>Looking forward to this event! The AI keynote sounds particularly interesting.</p>
                        <div class="comment-meta">
                            <span>2 hours ago</span>
                            <button class="comment-action"><i class="fas fa-thumbs-up"></i> 5</button>
                            <button class="comment-action"><i class="fas fa-reply"></i></button>
                        </div>
                    </div>
                </div>
                
                <div class="comment">
                    <div class="comment-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="comment-content">
                        <h4>Jane Smith</h4>
                        <p>Will there be recordings available for those who can't attend?</p>
                        <div class="comment-meta">
                            <span>1 day ago</span>
                            <button class="comment-action"><i class="fas fa-thumbs-up"></i> 2</button>
                            <button class="comment-action"><i class="fas fa-reply"></i></button>
                        </div>
                    </div>
                </div>
            </div>
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