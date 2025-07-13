<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Promo Slider</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .promo-slider {
            overflow-x: auto;
            display: flex;
            scroll-behavior: smooth;
            scrollbar-width: none; 
        }
        .promo-slider::-webkit-scrollbar {
            display: none; 
        }
        .promo-card {
            min-width: 300px; 
            margin-right: 1rem; 
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.50);
            transition: transform 0.3s;
            background: white;
        }
        .promo-card:hover {
            transform: scale(1.01);
        }
        .promo-image {
            width: 100%;
            height: 200px;
            object-fit: cover; 
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .dots {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }
        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: gray;
            margin: 0 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .active {
            background-color: white;
        }
        .nav-button {
            background-color: white;
            border: none;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .nav-button:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-center mb-6">Promo Spesial</h1>
        <div class="relative">
            <div class="promo-slider" id="promoSlider">
                <!-- Promo Cards -->
                <div class="promo-card p-6">
                    <img src="25_.png" alt="Cashback 25%" class="promo-image">
                    <h3 class="text-xl font-semibold">Cashback 25%</h3>
                    <p>Dapatkan cashback 25% untuk semua transaksi pembiayaan syariah minimal Rp 3 juta.</p>
                    <a href="comingsoon.php" class="text-indigo-600 hover:underline">Detail Promo</a>
                </div>
                <div class="promo-card p-6">
                    <img src="priority.jpg" alt="Priority Banking" class="promo-image">
                    <h3 class="text-xl font-semibold">Priority Banking</h3>
                    <p>Nikmati berbagai keuntungan khusus sebagai nasabah priority dengan saldo minimal Rp 50 juta.</p>
                    <a href="comingsoon.php" class="text-indigo-600 hover:underline">Detail Promo</a>
                </div>
                <div class="promo-card p-6">
                    <img src="30.jpg" alt="Diskon 30%" class="promo-image">
                    <h3 class="text-xl font-semibold">Diskon 30%</h3>
                    <p>Spesial Harbolnas! Diskon hingga 30% dan gratis biaya admin untuk semua transaksi.</p>
                    <a href="comingsoon.php" class="text-indigo-600 hover:underline">Detail Promo</a>
                </div>
                <div class="promo-card p-6">
                    <img src="syariah.jpg" alt="Nisbah 80%" class="promo-image">
                    <h3 class="text-xl font-semibold">Nisbah 80%</h3>
                    <p>Bagi hasil deposito syariah meningkat menjadi 80% untuk bulan Juli 2023.</p>
                    <a href="comingsoon.php" class="text-indigo-600 hover:underline">Detail Promo</a>
                </div>
                <div class="promo-card p-6">
                    <img src="berkah.jpg" alt="Berbagi Berkah" class="promo-image">
                    <h3 class="text-xl font-semibold">Berbagi Berkah</h3>
                    <p>Program khusus Ramadhan dengan bagi hasil tambahan dan donasi untuk kegiatan sosial.</p>
                    <a href="comingsoon.php" class="text-indigo-600 hover:underline">Detail Promo</a>
                </div>
            </div>
            <button id="prevBtn" class="nav-button absolute left-0 top-1/2 transform -translate-y-1/2">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="nextBtn" class="nav-button absolute right-0 top-1/2 transform -translate-y-1/2">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        <div class="dots" id="dotsContainer"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('promoSlider');
            const dotsContainer = document.getElementById('dotsContainer');
            const cards = document.querySelectorAll('.promo-card');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            cards.forEach((_, index) => {
                const dot = document.createElement('div');
                dot.className = 'dot';
                dot.dataset.index = index;
                dot.addEventListener('click', () => {
                    const cardWidth = cards[0].offsetWidth + 16; 
                    slider.scrollTo({
                        left: index * cardWidth,
                        behavior: 'smooth'
                    });
                    updateActiveDot(index);
                });
                dotsContainer.appendChild(dot);
            });

            const updateActiveDot = (activeIndex) => {
                const dots = dotsContainer.querySelectorAll('.dot');
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === activeIndex);
                });
            };

            slider.addEventListener('scroll', () => {
                const scrollPosition = slider.scrollLeft;
                const cardWidth = cards[0].offsetWidth + 16; 
                const totalWidth = cardWidth * cards.length;
                const maxScroll = totalWidth - slider.clientWidth;

                let activeIndex = Math.round(scrollPosition / cardWidth);
                if (scrollPosition >= maxScroll) {
                    activeIndex = cards.length - 1; 
                }
                updateActiveDot(activeIndex);
            });

            nextBtn.addEventListener('click', () => {
                const cardWidth = cards[0].offsetWidth + 16; 
                slider.scrollBy({
                    left: cardWidth,
                    behavior: 'smooth'
                });
            });

            prevBtn.addEventListener('click', () => {
                const cardWidth = cards[0].offsetWidth + 16; 
                slider.scrollBy({
                    left: -cardWidth,
                    behavior: 'smooth'
                });
            });

            updateActiveDot(0);
        });
    </script>
</body>
</html>