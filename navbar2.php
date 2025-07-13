<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>

    <style>
        .top-header {
            background-color: rgba(31, 80, 241, 0.664);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999;
            backdrop-filter: blur(1.5px);
            height: 70px;
            box-sizing: border-box;
        }

        .logo-container {
            display: flex;
            align-items: center;
            padding-left: 50px;
        }

        .logo {
            height: 120px; 
            width: auto;
            max-width: 100%;
            padding-top: 7px;
        }

        .menu-items {
            position: absolute;
            left: 65%;
            transform: translateX(-50%);
            display: flex;
            gap: 30px;
            z-index: 1;
        }

        .menu-items a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
        }

        /* Burger tombol */
        .burger {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 25px;
            height: 20px;
            cursor: pointer;
            position: absolute;
            right: 20px;
            z-index: 1001;
        }

        .burger span {
            height: 3px;
            width: 100%;
            background: white;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        /* Animasi burger */
        .burger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .burger.active span:nth-child(2) {
            opacity: 0;
        }

        .burger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        /* Responsif*/
        @media (max-width: 768px) {
            .burger {
                display: flex;
            }

            .menu-items {
                display: none;
                flex-direction: column;
                background-color: rgba(56, 100, 245, 0.95);
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                padding: 15px 0;
                text-align: center;
                z-index: 1000;
                transform: none !important;
            }

            .menu-items.show {
                display: flex;
                animation: fadeSlide 0.3s ease;
            }

            .menu-items a {
                padding: 10px 0;
                font-size: 16px;
            }

            .logo {
                height: 112px; 
                padding-left: 20px;
            }
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(-10%);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="top-header">
        <div class="logo-container">
            <img src="jtng-removebg-preview.png" alt="Logo Bank Jateng" class="logo">
        </div>

        <div class="burger" id="burger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="menu-items" id="menu">
            <a href="home.php">beranda</a>
            <a href="transaksi.php">transaksi</a>
            <a href="portofolio.php">portofolio</a>
            <a href="syariah2.php">Syariah</a>
        </div>
    </div>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            const burger = document.getElementById('burger');

            menu.classList.toggle('show');
            burger.classList.toggle('active');
        }
    </script>
</body>
</html>