<?php
// Get current year for copyright
$currentYear = date('Y');
?>
        </div> <!-- Close main content div -->
        
        <footer class="admin-footer">
            <div class="footer-content">
                <div class="footer-info">
                    <p>&copy; <?php echo $currentYear; ?> Good Food Admin Panel. All rights reserved.</p>
                </div>
                <div class="footer-links">
                    <a href="index.php" target="_blank">View Website</a>
                    <span class="separator">|</span>
                    <a href="signin.php">Sign In</a>
                </div>
            </div>
        </footer>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <!-- Custom Admin JavaScript -->
        <script>
            // Add active class to current page in navigation
            $(document).ready(function() {
                const currentPage = window.location.pathname.split('/').pop();
                $('.admin-nav a').each(function() {
                    const href = $(this).attr('href');
                    if (href === currentPage) {
                        $(this).addClass('active');
                    }
                });

                // Toggle mobile menu
                $('.mobile-menu-btn').click(function() {
                    $('.admin-nav').toggleClass('show');
                });

                // Close mobile menu when clicking outside
                $(document).click(function(event) {
                    if (!$(event.target).closest('.admin-nav, .mobile-menu-btn').length) {
                        $('.admin-nav').removeClass('show');
                    }
                });
            });
        </script>
    </body>
</html>

<style>
.admin-footer {
    background-color: #2c3e50;
    color: #ecf0f1;
    padding: 20px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 1000;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer-info p {
    margin: 0;
    font-size: 14px;
}

.footer-links {
    display: flex;
    align-items: center;
    gap: 15px;
}

.footer-links a {
    color: #ecf0f1;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: #3498db;
}

.separator {
    color: #7f8c8d;
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }

    .footer-links {
        justify-content: center;
    }
}

/* Add padding to main content to prevent footer overlap */
.main-content {
    padding-bottom: 80px;
}
</style> 