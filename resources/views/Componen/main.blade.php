<style>
    
    .dropdown-item:hover {
        text-decoration: underline;
        color: #0056b3;
    }

    .dropdown-item {
        transition: color 0.3s, text-decoration 0.3s;
    }

    .navbar-brand {
        margin-right: 20px;
    }

    .nav-link {
        display: flex;
        align-items: center;
    }

    .nav-link ion-icon {
        margin-right: 5px;
    }

    .size {
        font-size: 30px;
        /* Adjust the font size as needed */
        width: 30px;
        /* Adjust the width as needed */
        height: 30px;
        /* Adjust the height as needed */
    }

    /* Media Queries for Responsive Design */
    @media (max-width: 768px) {
        .navbar-nav {
            text-align: center;
        }

        .navbar-collapse {
            margin-top: 10px;
        }
    }

    @media (max-width: 576px) {
        .size {
            font-size: 24px;
            /* Adjust the font size for small screens */
            width: 24px;
            /* Adjust the width for small screens */
            height: 24px;
            /* Adjust the height for small screens */
        }

        .film-card {
            flex: 0 0 calc(50% - 20px);
        }

        .film-container {
            padding: 5px;
        }
    }

    /* Dark Mode Styles */
    body,
    .navbar,
    .card,
    .dropdown-menu,
    .modal-content {
        transition: background-color 0.3s, color 0.3s;
    }

    .dark-mode {
        background-color: #121212;
        color: #e0e0e0;
    }

    .dark-mode .navbar,
    .dark-mode .card,
    .dark-mode .dropdown-menu,
    .dark-mode .modal-content {
        background-color: #1e1e1e;
        color: #e0e0e0;
    }

    .dark-mode .btn-outline-success {
        border-color: #e0e0e0;
        color: #e0e0e0;
    }

    .dark-mode .btn-outline-success:hover {
        background-color: #333;
    }

    .dark-mode .btn-dark {
        background-color: #333;
        border: none;
    }

    .dark-mode .btn-dark:hover {
        background-color: #444;
    }

    /* Custom CSS for Navbar Colors */
    .navbar-light {
        background-color: #f8f9fa !important;
        color: blue;
    }

    .navbar-dark {
        background-color: #343a40 !important;
        color: #ffffff !important;
    }

    .navbar-primary {
        background-color: #007bff !important;
        color: #ffffff !important;
    }

    .navbar-secondary {
        background-color: #6c757d !important;
        color: #ffffff !important;
    }

    .navbar-success {
        background-color: #28a745 !important;
        color: #ffffff !important;
    }

    .navbar-danger {
        background-color: #dc3545 !important;
        color: #ffffff !important;
    }

    .navbar-primary-rgba {
        background-color: rgba(31, 172, 171, 0.8);
        color: aqua;
    }

    .offcanvas {
        background-color: #f8f9fa;
        /* Light background color */
    }

    .offcanvas-header {
        background-color: #343a40;
        /* Dark background color */
        color: #ffffff;
        /* White text color */
    }

    .offcanvas-body {
        padding: 20px;
    }

    .offcanvas-body ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .offcanvas-body li {
        margin-bottom: 10px;
    }

    .offcanvas-body a {
        color: #343a40;
        /* Dark text color */
        text-decoration: none;
        font-weight: bold;
    }

    .offcanvas-body a:hover {
        text-decoration: underline;
    }
</style>