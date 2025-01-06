<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Footer Diskominfo Kubu Raya</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #3b82f6;
            --text-color-dark: #1f2937;
            --text-color-light: #0445c8;
            --background-color: white;
        }

        footer {
            background-color: var(--background-color);
            padding: 1rem 0;
            border-top: 1px solid #d1d5db;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .footer-bottom {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding-top: 1rem;
            border-top: 1px solid #d1d5db;
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .footer-copyright {
            font-size: 0.75rem;
            color: var(--text-color-light);
            margin-bottom: 0.5rem;
        }

        .footer-icons {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .footer-icons a {
            color: orange;
            font-size: 1rem; /* Smaller icon size */
            transition: all 0.3s ease;
            padding: 0.25rem;
        }

        .footer-icons a:hover {
            color: orange;
            transform: scale(1.4);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .footer-icons a {
                font-size: 0.75rem;
                padding: 0.2rem;
            }
        }
    </style>
</head>
<body>
    <footer>
        <div class="footer-content">
            <div class="footer-copyright">
                
    Copyright &copy; 2024 Sistem Informasi Magang.
            </div>
            <div class="footer-icons">
                <a href="https://perkim.kalbarprov.go.id/" target="_blank" aria-label="Website">
                    <i class="fas fa-globe"></i>
                </a>
                <a href="https://www.instagram.com/diskominfokuburaya" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="mailto:disperkim@kalbarprov.go.id" aria-label="Email">
                    <i class="fas fa-envelope"></i>
                </a>
                <a href="https://maps.app.goo.gl/4BERFB9DskoFiFBX9" target="_blank" aria-label="Location">
                    <i class="fas fa-map-marker-alt"></i>
                </a>
            </div>
        </div>
    </footer>
</body>
</html>