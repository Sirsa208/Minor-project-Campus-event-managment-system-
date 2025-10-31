# Campus Event Management System

A modern, responsive website for managing campus events built with HTML, CSS, JavaScript, and PHP.

## Features

- **Event Discovery**: Browse and search for upcoming campus events
- **Event Management**: Create, update, and delete events
- **User Registration & Authentication**: Secure login system for students and faculty
- **Event Registration**: Register for events with automatic confirmation
- **Calendar View**: Visual calendar for easy event planning
- **Responsive Design**: Works on all devices from mobile to desktop
- **Modern UI/UX**: Clean, attractive interface with smooth animations

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Styling**: Custom CSS with Google Fonts and Font Awesome icons
- **Responsive Design**: Mobile-first approach with media queries

## Setup Instructions

1. **Prerequisites**:
   - Web server (Apache, Nginx, etc.)
   - PHP 7.0 or higher
   - MySQL database

2. **Installation**:
   - Clone or download this repository to your web server directory
   - Create a MySQL database using the schema in `database.sql`
   - Update database credentials in `config.php`
   - Start your web server

3. **Database Setup**:
   - Import `database.sql` into your MySQL database
   - This will create the necessary tables and sample data

4. **Configuration**:
   - Modify `config.php` with your database credentials
   - Adjust any other settings as needed

## File Structure

```
campus-event-manager/
├── index.html          # Home page
├── styles.css          # Main stylesheet
├── script.js           # Client-side JavaScript
├── config.php          # Configuration file
├── database.sql        # Database schema
├── auth.php            # Authentication handler
├── search.php          # Event search functionality
├── events.php          # Event management page
├── dashboard.php       # User dashboard
├── event-details.php   # Event details page
├── login.html          # User login page
├── register.html       # User registration page
└── README.md           # This file
```

## Pages

1. **Home Page** (`index.html`): Landing page with event highlights
2. **Events Page** (`events.php`): Manage and view all events
3. **Dashboard** (`dashboard.php`): User dashboard with personalized content
4. **Event Details** (`event-details.php`): Detailed view of a specific event
5. **Login** (`login.html`): User authentication page
6. **Register** (`register.html`): New user registration page
7. **Search** (`search.php`): Search events by keywords

## Customization

To customize the theme colors:
1. Edit the CSS variables in `styles.css`
2. Modify the gradient colors in the `.primary-btn` and other gradient classes
3. Update the color scheme in the calendar and event cards

## Contributing

1. Fork the repository
2. Create a new branch for your feature
3. Commit your changes
4. Push to your branch
5. Create a pull request

## License

This project is open source and available under the MIT License.

## Support

For support, please contact the development team or open an issue in the repository.