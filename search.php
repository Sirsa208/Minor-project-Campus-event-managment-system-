<?php
// Search functionality for CampusEvents

// Include configuration
require_once 'config.php';

// Function to search events
function searchEvents($query) {
    // In a real application, you would:
    // 1. Connect to the database
    // 2. Execute a search query using LIKE statements
    // 3. Return matching events
    
    // For demonstration, we'll return sample data
    $events = [
        [
            'id' => 1,
            'title' => 'Tech Conference 2025',
            'description' => 'Join us for the biggest tech conference on campus featuring industry experts and workshops.',
            'date' => '2025-10-30 10:00:00',
            'location' => 'Main Auditorium',
            'organizer' => 'Computer Science Department'
        ],
        [
            'id' => 2,
            'title' => 'Annual Cultural Fest',
            'description' => 'Celebrate diversity and creativity with performances, food, and cultural exhibitions.',
            'date' => '2025-11-05 14:00:00',
            'location' => 'Campus Ground',
            'organizer' => 'Cultural Committee'
        ]
    ];
    
    // Filter events based on search query (simplified)
    $results = [];
    foreach ($events as $event) {
        if (stripos($event['title'], $query) !== false || 
            stripos($event['description'], $query) !== false ||
            stripos($event['organizer'], $query) !== false) {
            $results[] = $event;
        }
    }
    
    return $results;
}

// Handle search form submission
$searchResults = [];
$searchQuery = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['q'])) {
    $searchQuery = sanitizeInput($_GET['q']);
    $searchResults = searchEvents($searchQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - CampusEvents</title>
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
                    <li class="nav-item"><a href="login.html" class="nav-link">Login</a></li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Search Results Content -->
    <main class="container">
        <h1 class="section-title">Search Results</h1>
        
        <form class="search-form" method="GET">
            <div class="search-container">
                <input type="text" name="q" placeholder="Search events..." value="<?php echo htmlspecialchars($searchQuery); ?>" required>
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </div>
        </form>
        
        <?php if (!empty($searchQuery)): ?>
            <div class="search-info">
                <p>Found <?php echo count($searchResults); ?> result(s) for "<?php echo htmlspecialchars($searchQuery); ?>"</p>
            </div>
            
            <?php if (count($searchResults) > 0): ?>
                <div class="events-grid">
                    <?php foreach ($searchResults as $event): ?>
                        <div class="event-card">
                            <div class="event-image">
                                <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="<?php echo htmlspecialchars($event['title']); ?>">
                            </div>
                            <div class="event-content">
                                <span class="event-date"><?php echo date('M j, Y', strtotime($event['date'])); ?></span>
                                <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                                <p><?php echo htmlspecialchars(substr($event['description'], 0, 100)) . '...'; ?></p>
                                <div class="event-meta">
                                    <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></span>
                                    <span><i class="fas fa-clock"></i> <?php echo date('g:i A', strtotime($event['date'])); ?></span>
                                </div>
                                <a href="event-register.php?event_id=<?php echo $event['id']; ?>" class="btn small-btn">Register Now</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-results">
                    <i class="fas fa-search fa-3x"></i>
                    <h3>No events found</h3>
                    <p>Try different search terms or browse all events.</p>
                    <a href="events.php" class="btn primary-btn">View All Events</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
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
                        <li><a href="login.html">Login</a></li>
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