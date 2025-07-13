<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perbankan Syariah</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
      color: #333;
    }

    header {
      background-color: #ffffff;
      color: #026937;
      padding: 3rem 1rem;
      text-align: center;
    }

    .container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #026937;
      font-size: 2rem;
    }

    h2 {
      margin-top: 2rem;
      color: #444;
      font-size: 1.2rem;
    }

    p, li {
      line-height: 1.7;
      font-size: 1rem;
    }

    ul {
      padding-left: 1.5rem;
    }

  
  </style>
</head>
<body>

<?php include 'navbar.php' ?>


<header>
  <h1>Perbankan Syariah</h1>
  <p>Menjaga Nilai, Membangun Keuangan Berbasis Etika Islam</p>
</header>

<div class="container">
  <h2>Apa Itu Perbankan Syariah?</h2>
  <p>Perbankan syariah adalah sistem keuangan yang berlandaskan prinsip-prinsip Islam (syariah), termasuk larangan terhadap riba (bunga), gharar (ketidakpastian), dan maysir (perjudian). Semua produk dan layanan yang ditawarkan harus sesuai dengan hukum Islam dan diawasi oleh Dewan Pengawas Syariah.</p>

  <h2>Prinsip Utama Perbankan Syariah</h2>
  <ul>
    <li><strong>Tanpa Riba:</strong> Tidak menggunakan bunga, melainkan sistem bagi hasil (mudharabah dan musyarakah).</li>
    <li><strong>Transparansi:</strong> Semua perjanjian harus jelas dan adil bagi kedua belah pihak.</li>
    <li><strong>Etika dan Keadilan:</strong> Mendorong kegiatan ekonomi yang etis dan bermanfaat bagi masyarakat.</li>
  </ul>

  <h2>Keuntungan Perbankan Syariah</h2>
  <p>Dengan menghindari spekulasi dan transaksi yang tidak etis, perbankan syariah menawarkan solusi keuangan yang lebih stabil dan berorientasi pada kesejahteraan umat. Hal ini menjadikannya pilihan yang menarik bagi mereka yang menginginkan keuangan yang bersih dan transparan.</p>

  <h2>Kesimpulan</h2>
  <p>Perbankan syariah bukan hanya alternatif, tetapi juga sistem keuangan yang semakin diminati karena integritas dan prinsip-prinsip kemanusiaan yang dipegangnya. Mari dukung ekonomi syariah demi Indonesia yang lebih berkah.</p>
</div>





</body>
</html>
