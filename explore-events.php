<?php
// Include configuration
require_once 'config.php';

// In a real application, you would fetch events from the database
// For demonstration, we'll create sample events

// Generate sample events
$events = [];
$departments = ['Computer Science', 'Engineering', 'Business', 'Arts & Humanities', 'Science', 'Medicine', 'Law'];
$eventTypes = ['Conference', 'Workshop', 'Seminar', 'Festival', 'Competition', 'Exhibition', 'Networking'];

for ($i = 1; $i <= 25; $i++) {
    $daysOffset = rand(-30, 30); // Events in the past 30 days to future 30 days
    $eventDate = date('Y-m-d H:i:s', strtotime("+$daysOffset days"));
    
    $events[] = [
        'id' => $i,
        'title' => $eventTypes[array_rand($eventTypes)] . ' ' . date('Y', strtotime($eventDate)),
        'description' => 'Join us for this exciting event featuring industry experts and workshops.',
        'date' => $eventDate,
        'location' => 'Location ' . chr(65 + ($i % 10)),
        'organizer' => $departments[array_rand($departments)],
        'department' => $departments[array_rand($departments)],
        'attendees' => rand(20, 200)
    ];
}

// Sort events by date
usort($events, function($a, $b) {
    return strtotime($a['date']) - strtotime($b['date']);
});

// Filter events based on type
$eventType = isset($_GET['type']) ? $_GET['type'] : 'all';
$departmentFilter = isset($_GET['dept']) ? $_GET['dept'] : 'all';

$filteredEvents = $events;

if ($eventType !== 'all') {
    $filteredEvents = array_filter($filteredEvents, function($event) use ($eventType) {
        $isUpcoming = strtotime($event['date']) > time();
        $isPast = strtotime($event['date']) <= time();
        
        if ($eventType === 'upcoming') {
            return $isUpcoming;
        } elseif ($eventType === 'past') {
            return $isPast;
        }
        return true;
    });
}

if ($departmentFilter !== 'all') {
    $filteredEvents = array_filter($filteredEvents, function($event) use ($departmentFilter) {
        return $event['department'] === $departmentFilter;
    });
}

// Pagination
$eventsPerPage = 12;
$totalEvents = count($filteredEvents);
$totalPages = ceil($totalEvents / $eventsPerPage);
$currentPage = isset($_GET['page']) ? max(1, min((int)$_GET['page'], $totalPages)) : 1;
$offset = ($currentPage - 1) * $eventsPerPage;

$paginatedEvents = array_slice($filteredEvents, $offset, $eventsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Events - CampusEvents</title>
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

    <!-- Explore Events Content -->
    <main class="container">
        <h1 class="section-title">Explore Campus Events</h1>
        
        <!-- Filters -->
        <div class="filters">
            <div class="filter-group">
                <label for="event-type">Event Type:</label>
                <select id="event-type" class="epic-select" onchange="filterEvents()">
                    <option value="all" <?php echo ($eventType === 'all') ? 'selected' : ''; ?>>All Events</option>
                    <option value="upcoming" <?php echo ($eventType === 'upcoming') ? 'selected' : ''; ?>>Upcoming Events</option>
                    <option value="past" <?php echo ($eventType === 'past') ? 'selected' : ''; ?>>Past Events</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="department">Department:</label>
                <select id="department" class="epic-select" onchange="filterEvents()">
                    <option value="all" <?php echo ($departmentFilter === 'all') ? 'selected' : ''; ?>>All Departments</option>
                    <?php foreach (array_unique(array_column($events, 'department')) as $dept): ?>
                        <option value="<?php echo $dept; ?>" <?php echo ($departmentFilter === $dept) ? 'selected' : ''; ?>>
                            <?php echo $dept; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="filter-group">
                <button class="btn epic-btn" onclick="resetFilters()">Reset Filters</button>
            </div>
        </div>
        
        <!-- Events Stats -->
        <div class="events-stats">
            <div class="stat-card">
                <i class="fas fa-calendar-day stat-icon"></i>
                <div class="stat-info">
                    <h3><?php echo count(array_filter($events, function($e) { return strtotime($e['date']) > time(); })); ?></h3>
                    <p>Upcoming Events</p>
                </div>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-history stat-icon"></i>
                <div class="stat-info">
                    <h3><?php echo count(array_filter($events, function($e) { return strtotime($e['date']) <= time(); })); ?></h3>
                    <p>Past Events</p>
                </div>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-users stat-icon"></i>
                <div class="stat-info">
                    <h3><?php echo array_sum(array_column($events, 'attendees')); ?></h3>
                    <p>Total Attendees</p>
                </div>
            </div>
        </div>
        
        <!-- Events Grid -->
        <div class="events-grid">
            <?php if (count($paginatedEvents) > 0): ?>
                <?php foreach ($paginatedEvents as $event): ?>
                    <?php 
                        $isUpcoming = strtotime($event['date']) > time();
                        $eventClass = $isUpcoming ? 'upcoming' : 'past';
                    ?>
                    <div class="event-card <?php echo $eventClass; ?>">
                        <div class="event-badge epic-badge <?php echo $isUpcoming ? 'upcoming-badge' : 'past-badge'; ?>">
                            <?php echo $isUpcoming ? 'Upcoming' : 'Past'; ?>
                        </div>
                        <div class="event-image">
                            <img src="https://images.unsplash.com/photo-<?php echo rand(1500000000, 1599999999); ?>?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="<?php echo htmlspecialchars($event['title']); ?>">
                        </div>
                        <div class="event-content">
                            <span class="event-date"><?php echo date('M j, Y', strtotime($event['date'])); ?></span>
                            <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                            <p><?php echo htmlspecialchars(substr($event['description'], 0, 80)) . '...'; ?></p>
                            <div class="event-meta">
                                <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></span>
                                <span><i class="fas fa-clock"></i> <?php echo date('g:i A', strtotime($event['date'])); ?></span>
                            </div>
                            <div class="event-footer">
                                <span class="department-tag epic-tag"><?php echo htmlspecialchars($event['department']); ?></span>
                                <span class="attendees"><i class="fas fa-user-friends"></i> <?php echo $event['attendees']; ?></span>
                            </div>
                            <a href="event-register.php?event_id=<?php echo $event['id']; ?>" class="btn small-btn">Register Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-events">
                    <i class="fas fa-calendar-times fa-3x"></i>
                    <h3>No events found</h3>
                    <p>Try adjusting your filters to see more events.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="?type=<?php echo $eventType; ?>&dept=<?php echo $departmentFilter; ?>&page=<?php echo $currentPage - 1; ?>" class="pagination-btn">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>
                <?php endif; ?>
                
                <span class="pagination-info">
                    Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?>
                </span>
                
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?type=<?php echo $eventType; ?>&dept=<?php echo $departmentFilter; ?>&page=<?php echo $currentPage + 1; ?>" class="pagination-btn">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </div>
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
        function filterEvents() {
            const eventType = document.getElementById('event-type').value;
            const department = document.getElementById('department').value;
            window.location.href = `?type=${eventType}&dept=${department}`;
        }
        
        function resetFilters() {
            window.location.href = '?type=all&dept=all';
        }
    </script>
</body>
</html>