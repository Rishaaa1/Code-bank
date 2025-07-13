
<?php
session_start();
if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bank Jateng</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        html,
        body {
            height: 100%; 
            margin: 0;
            padding: 0;
            overflow-x: 
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #c2caf1;
            font-family: 'Poppins', sans-serif;
            scroll-snap-type: y mandatory;
            overflow-y: scroll;
        }

        /* Hero Section */
        .hero {
            background-image: url('latar-home.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 0 5px 35.5% 0;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
            min-height: 100vh; 
            height: 100vh; 
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            text-align: center; 
            padding: 20px; 
        }

        section {
            padding: 50px 15px;
            text-align: center;
        }

        h2 {
            font-weight: 800;
            font-size: 28px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .divider {
            width: 60px;
            border: 2px solid #000;
            margin: 0 auto 40px auto;
        }

        .card-box {
            background-color: #043266;
            padding: 40px 20px;
            border-radius: 14px;
            color: white;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .profile-img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        p {
            margin: 8px 0;
            line-height: 1.7;
        }

        @media (max-width: 600px) {
            h2 {
                font-size: 22px;
            }

            .card-box {
                padding: 30px 15px;
            }

            p {
                font-size: 15px;
            }
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #008080;
            margin-bottom: 20px;
        }

        .desc {
            font-size: 18px;
            line-height: 1.8;
            color: #333;
            padding-top: 3cm;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .desc {
                font-size: 16px;
            }
        }

        /*footer*/
        footer {
            width: 100%;
            background-color: #11468F; 
            color: white;
            padding-top: 10px; 
        }

        footer a {
            color: white;
        }

        .footer {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 10px 10px;
        }

        .footer-column {
            flex: 1 1 200px;
            padding: 10px 78px;
            box-sizing: border-box;
            border-right: 1px solid rgba(255, 255, 255, 0.3);
        }

        .footer-column:last-child {
            border-right: none;
        }

        .footer-column h4 {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .footer-column p {
            font-weight: 600;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
        }

        .footer-divider {
            height: 1px;
            width: 85%;
            background-color: white;
            margin: 0 auto; 
        }

        .copyright {
            background-color: #041562;
            color: white;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 80%;
            text-align: center;
            font-size: 12px;
            padding: 12px; 
        }

        .space {
            padding-top: 15px;
            padding-bottom: 3px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .footer {
                flex-direction: column;
                align-items: center;
            }

            .footer-column {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.3);
                text-align: center;
                padding: 20px;
            }

            .footer-column:last-child {
                border-bottom: none;
            }

            .copyright {
                flex-direction: column; 
                gap: 10px; 
                padding: 15px; 
            }
        }

        header {
            text-align: center;
            padding: 30px 20px;
            color: #4b82e7;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: 600;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #b2dfdb;
            border-radius: 8px;
            font-size: 1rem;
        }

        button {
            background-color: #00796b;
            color: white;
            border: none;
            padding: 12px 20px;
            margin-top: 20px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #004d40;
        }

        .result,
        .history {
            margin-top: 20px;
            padding: 20px;
            background: #e0f2f1;
            border-radius: 8px;
            font-size: 1rem;
        }

        .history {
            background: #f1f8e9;
        }
    </style>
    <script src="java.js"></script>
</head>

<body>
<?php include 'navbar2.php'?>
<?php include 'smartbar2.php'; ?>
    <div class="hero">
        Selamat Datang di Bank Jateng
    </div>

    <?php include 'promo.php'; ?>


    <footer>
        <div class="footer">
            <div class="footer-column">
                <h4>KANTOR PUSAT</h4>
                <p>Gedung Grinatha Lt. 1-7, Jalan Pemuda<br>No. 142 Semarang</p>
                <p>
                    <i class="bi bi-geo-alt-fill"></i>
                    <a href="https://www.bing.com/ck/a?!&&p=48d430baedad25aa6c3ed0f10032cdc19ef9d64c2d9806c34c9eccb7b3c2cdf1JmltdHM9MTc1MDIwNDgwMA&ptn=3&ver=2&hsh=4&fclid=202b01d1-cc97-6977-126f-1524cd966895&u=a1L21hcHM_Jm1lcGk9MTA3fkxvY2FsflRvcE9mUGFnZX5FbnRpdHlfVmVydGljYWxfTGlzdF9DYXJkJnR5PTE3JnE9bGluayUyMGxva2FzaSUyMGJhbmslMjBqYXRlbmcmc2VnbWVudD1Mb2NhbCZwcG9pcz0tNy41NDIwMTMxNjgzMzQ5NjFfMTEwLjgyMDE4MjgwMDI5Mjk3X0JhbmslMjBKYXRlbmclMjBLQ1AlMjBOdXN1a2FuJTIwU3VyYWthcnRhX1lONzk5OXgzNzY3NjEwMzczNzUxNTU0NTkxfi03LjU2ODk1MzUxNDA5OTEyMV8xMTAuODE4MDkyMzQ2MTkxNF9iYW5rJTIwSmF0ZW5nJTIwU3lhcmlhaF9ZTjc5OTl4MTc3MDM5NzQ5MjU3NTQxNjAwOH4tNy41NzEyMDgwMDAxODMxMDU1XzExMC44MjYzMzk3MjE2Nzk2OV9CYW5rJTIwSmF0ZW5nJTIwQ2FiYW5nJTIwU3VyYWthcnRhX1lONzk5OXgxMDMwNzI5OTg4OTkyNDQzNzIwMn4tNy41NTMxNjkyNTA0ODgyODFfMTEwLjgyMjMwMzc3MTk3MjY2X0JhbmslMjBKYXRlbmclMjBTeXJpYWglMjBLQ1AlMjBVTVNfWU43OTk5eDU0MDkyMTk4MjE5Nzk2OTYyNzdafi03LjU2NjIzNjk3MjgwODgzOF8xMTAuODA5ODIyMDgyNTE5NTNfQmFuayUyMEphdGVuZyUyMFN5YXJpYWhfWU43OTk5eDEwMzEyMjMwNjI0ODU4NjE5NzkwfiZzZWk9MCZjcD0tNy41Njg5NTR-MTEwLjgxODA5MiZjaGlsZD0lMjZ0eSUzRDE4JTI2cSUzRGJhbmslMjUyMEphdGVuZyUyNTIwU3lhcmlhaCUyNnNzJTNEeXBpZC5ZTjc5OTl4MTc3MDM5NzQ5MjU3NTQxNjAwOCUyNnNlZ21lbnQlM0RMb2NhbCUyNnBwb2lzJTNELTcuNTY4OTUzNTE0MDk5MTIxXzExMC44MTgwOTIzNDYxOTE0X2JhbmslMjUyMEphdGVuZyUyNTIwU3lhcmlhaF9ZTjc5OTl4MTc3MDM5NzQ5MjU3NTQxNjAwOH4lMjZjcCUzRC03LjU2ODk1NH4xMTAuODE4MDkyJTI2RW5hYmxlTWFwVmlld0NoYW5nZSUzRHRydWUmRk9STT1NUFNSUEw&ntb=1"
                        class="text-white text-decoration-underline" target="_blank">Lokasi Bank Jateng Lainnya</a>
                </p>
            </div>
            <div class="footer-column">
                <h4>HUB KAMI</h4>
                <p><i class="bi bi-telephone"></i> Call Center & Pengaduan 14066</p>
                <p><i class="bi bi-envelope"></i> callcenter14066@bankjateng.co.id</p>
                <p><i class="bi bi-telephone-fill"></i> Kantor Pusat 024-3547541</p>
                <p><i class="bi bi-envelope-at"></i> sekretaris.perusahaan@bankjateng.co.id</p>
            </div>

            <div class="footer-column">
                <h4>MEDIA SOCIAL</h4>
                <p><i class="bi bi-twitter"></i> @bank_jateng</p>
                <p><i class="bi bi-facebook"></i> Bank Jateng</p>
                <p><i class="bi bi-youtube"></i> @bankjateng</p>
                <p><i class="bi bi-instagram"></i> @bank_jateng</p>
            </div>

            <div class="footer-column">
                <h4>TAUTAN</h4>
                <p><a href="#" class="text-white text-decoration-underline">PPID Bank Jateng</a></p>
                <p><a href="#" class="text-white text-decoration-underline">Kalender Digital</a></p>
                <p><a href="#" class="text-white text-decoration-underline">Majalah Zinergi</a></p>
                <p><a href="#" class="text-white text-decoration-underline">FAQ</a></p>
                <p><a href="#" class="text-white text-decoration-underline">Waspada Penipuan</a></p>
            </div>
        </div>

        <div class="footer-divider"></div>
        <div class="copyright">
            <p class="mb-0">Bank Jateng berizin dan diawasi oleh Otoritas Jasa Keuangan. &nbsp;|&nbsp; Bank Jateng
                merupakan
                peserta penjaminan LPS. &nbsp;|&nbsp;
                <a href="#" class="text-white text-decoration-underline">SDBK</a> |
                <a href="#" class="text-white text-decoration-underline">Kebijakan Privasi</a> |
                <a href="#" class="text-white text-decoration-underline">Syarat dan Ketentuan</a>
            </p>
        </div>
    </footer>
    <script>
        const dueDate = new Date("2025-06-22");
        const today = new Date();
        const reminderBox = document.getElementById("reminderBox");
        const reminderText = document.getElementById("reminderText");

        const oneDay = 24 * 60 * 60 * 1000;
        const daysRemaining = Math.round((dueDate - today) / oneDay);

        if (daysRemaining <= 3) {
            if (daysRemaining > 0) {
                reminderText.innerText = `⚠️ Pengingat: Tagihan/Nisbah akan jatuh tempo dalam ${daysRemaining} hari.`;
            } else if (daysRemaining === 0) {
                reminderText.innerText = `📢 Hari ini adalah jatuh tempo Tagihan/Nisbah!`;
            } else {
                reminderText.innerText = `⏰ Tagihan/Nisbah sudah jatuh tempo ${Math.abs(daysRemaining)} hari yang lalu. Segera lakukan pembayaran!`;
            }
            if (reminderBox) { 
                reminderBox.style.display = "block";
            }
        }

        function dismissReminder() {
            if (reminderBox) { 
                reminderBox.style.display = "none";
            }
        }

        const sidebar = document.getElementById('sidebar');
        const burger = document.querySelector('.burger-wrapper');

        function toggleSidebar() {
            if (sidebar) {
                sidebar.classList.toggle('hidden');
            }
        }

        document.addEventListener('click', function (e) {
            if (sidebar && burger && !sidebar.contains(e.target) && !burger.contains(e.target)) {
                sidebar.classList.add('hidden');
            }
        });

        let hasilSebelumnya = null;

        function hitungNisbah() {
            const keuntunganInput = document.getElementById("keuntungan");
            const nisbahNasabahInput = document.getElementById("nisbahNasabah");
            const nisbahBankInput = document.getElementById("nisbahBank");
            const hasilElement = document.getElementById("hasil");
            const riwayatElement = document.getElementById("riwayat");

            if (!keuntunganInput || !nisbahNasabahInput || !nisbahBankInput || !hasilElement || !riwayatElement) {
                console.error("One or more required elements not found in the DOM.");
                return;
            }

            const keuntungan = parseFloat(keuntunganInput.value);
            const nisbahNasabah = parseFloat(nisbahNasabahInput.value);
            const nisbahBank = parseFloat(nisbahBankInput.value);


            if (isNaN(keuntungan) || isNaN(nisbahNasabah) || isNaN(nisbahBank)) {
                hasilElement.innerHTML = "❗ Harap isi semua kolom dengan angka yang valid.";
                return;
            }

            if (nisbahNasabah + nisbahBank !== 100) {
                hasilElement.innerHTML = "❗ Total nisbah harus 100%.";
                return;
            }

            const hasilNasabah = (keuntungan * nisbahNasabah) / 100;
            const hasilBank = (keuntungan * nisbahBank) / 100;

            if (hasilSebelumnya !== null) {
                riwayatElement.style.display = 'block';
                riwayatElement.innerHTML = `
                    🕘 <strong>Riwayat Terakhir:</strong><br>
                    Nasabah: <strong>Rp ${hasilSebelumnya.nasabah.toLocaleString()}</strong><br>
                    Bank: <strong>Rp ${hasilSebelumnya.bank.toLocaleString()}</strong>
                `;
            }

            hasilElement.innerHTML = `
                ✅ <strong>Hasil Pembagian:</strong><br>
                🧑 Nasabah: <strong>Rp ${hasilNasabah.toLocaleString()}</strong><br>
                🏦 Bank: <strong>Rp ${hasilBank.toLocaleString()}</strong>
            `;

            hasilSebelumnya = {
                nasabah: hasilNasabah,
                bank: hasilBank
            };
        }
    </script>
</body>

</html>