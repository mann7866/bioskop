
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .footer {
            background-color: white;
            color: #333;
            padding: 20px 0;
            bottom: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer p {
            margin: 0;
        }

        .footer .logo img {
            max-height: 200px;
            padding: 20px;
            object-fit: cover;
            width: auto;
        }

        .footer .social-media {
            margin-top: 10px;
        }

        .footer .social-media a {
            color: #333;
            margin: 0 10px;
            text-decoration: none;
            font-size: 1.2em;
            position: relative;
        }

        .footer .social-media a::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: royalblue;
            transition: all 0.3s;
        }

        .footer .social-media a:hover::after {
            background-color: red;
            left: 0;
            width: 100%;
        }

        .footer .quick-links {
            margin-top: 10px;
        }

        .footer .quick-links a {
            color: #333;
            margin: 0 10px;
            text-decoration: none;
            position: relative;
        }

        .footer .quick-links a::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: royalblue;
            transition: all 0.3s;
        }

        .footer .quick-links a:hover::after {
            background-color: red;
            left: 0;
            width: 100%;
        }

        .footer .footer-info {
            text-align: center;
        }
    </style>
</head>
<body>

    @yield('footer')
    <hr>
    <footer class="footer">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('Logo/1721275807_netflix.jpg') }}" alt="Bioskop Logo">
            </a>
        </div>
        <div class="footer-info">
            <p>&copy; 2024 Bioskop. All rights reserved.</p>
            <p>Alamat: Jl. Bioskop No. 123, Jakarta, Indonesia</p>
            <p>Kontak: +62 123 456 7890 | Email: info@bioskop.com</p>
            <div class="social-media">
                <a href="https://www.facebook.com" target="_blank">Facebook</a>
                <a href="https://www.twitter.com" target="_blank">Twitter</a>
                <a href="https://www.instagram.com" target="_blank">Instagram</a>
                <a href="https://www.youtube.com" target="_blank">YouTube</a>
            </div>
            <div class="quick-links">
                <a href="/about">Tentang Kami</a>
                <a href="/contact">Kontak</a>
                <a href="/privacy">Kebijakan Privasi</a>
                <a href="/terms">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>

    @yield('footer')
</body>
</html>