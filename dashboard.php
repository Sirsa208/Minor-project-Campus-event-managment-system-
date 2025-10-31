<?php
// In a real application, you would check if the user is logged in here
// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.html');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CampusEvents</title>
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
                    <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Dashboard Content -->
    <main class="container dashboard">
        <h1 class="section-title">My Dashboard</h1>
        
        <div class="dashboard-stats">
            <div class="stat-card">
                <i class="fas fa-calendar-alt stat-icon"></i>
                <div class="stat-info">
                    <h3>12</h3>
                    <p>Events Created</p>
                </div>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-users stat-icon"></i>
                <div class="stat-info">
                    <h3>245</h3>
                    <p>Total Registrations</p>
                </div>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-user stat-icon"></i>
                <div class="stat-info">
                    <h3>42</h3>
                    <p>Upcoming Events</p>
                </div>
            </div>
        </div>
        
        <div class="dashboard-content">
            <div class="dashboard-section">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h2><i class="fas fa-calendar-check"></i> My Upcoming Events</h2>
                    <a href="create-event.php" class="btn primary-btn">Create Event</a>
                </div>
                <div class="events-grid">
                    <div class="event-card">
                        <div class="event-image">
                            <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Tech Conference">
                        </div>
                        <div class="event-content">
                            <span class="event-date">Oct 30, 2025</span>
                            <h3>Tech Conference 2025</h3>
                            <p>Join us for the biggest tech conference on campus featuring industry experts and workshops.</p>
                            <div class="event-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Main Auditorium</span>
                                <span><i class="fas fa-clock"></i> 10:00 AM</span>
                            </div>
                            <a href="event-register.php?event_id=1" class="btn small-btn">Register Now</a>
                        </div>
                    </div>
                    
                    <div class="event-card">
                        <div class="event-image">
                            <img src="https://images.unsplash.com/photo-1464375117522-1311d134c7c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Cultural Fest">
                        </div>
                        <div class="event-content">
                            <span class="event-date">Nov 5, 2025</span>
                            <h3>Annual Cultural Fest</h3>
                            <p>Celebrate diversity and creativity with performances, food, and cultural exhibitions.</p>
                            <div class="event-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Campus Ground</span>
                                <span><i class="fas fa-clock"></i> 2:00 PM</span>
                            </div>
                            <a href="event-register.php?event_id=1" class="btn small-btn">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="dashboard-section">
                <h2><i class="fas fa-history"></i> Recent Activity</h2>
                <div class="activity-feed">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h4>New event created</h4>
                            <p>You created "Tech Conference 2025"</p>
                            <span class="activity-time">2 hours ago</span>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h4>New registration</h4>
                            <p>John Doe registered for "Annual Cultural Fest"</p>
                            <span class="activity-time">1 day ago</span>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-comment"></i>
                        </div>
                        <div class="activity-content">
                            <h4>New comment</h4>
                            <p>Jane Smith commented on "Inter-College Sports"</p>
                            <span class="activity-time">2 days ago</span>
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
                        <li><a href="dashboard.php">Dashboard</a></li>
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