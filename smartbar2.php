<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Smartbar Bank Jateng</title>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --smartbar-width: 90px;
      --smartbar-expanded-width: 220px;
      --side-panel-width: 420px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      padding-bottom: 80px;
    }

    .smartbar {
      position: fixed;
      bottom: 0;
      right: 0;
      height: 100vh;
      width: var(--smartbar-width);
      background-color: rgb(240, 39, 25);
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      transition: width 0.3s ease;
      overflow-y: auto;
      overflow-x: hidden;
      z-index: 1002;
    }

    .smartbar.hovered,
    .smartbar.expanded {
      width: var(--smartbar-expanded-width);
    }

    .smartbar a {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 30px 12px;
      color: white;
      text-decoration: none;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      transition: background 0.2s ease;
      cursor: pointer;
    }

    .smartbar a:hover,
    .smartbar a.active {
      background-color: #004f8a;
    }

    .smartbar a.active {
      background-color: white;
      color: #0066b3;
      font-weight: bold;
    }

    .smartbar a.active .material-symbols-outlined {
      color: #0066b3;
    }

    .smartbar span.material-symbols-outlined {
      font-size: 24px;
    }

    .smartbar .label {
      font-size: 14px;
      white-space: nowrap;
      opacity: 0;
      transition: opacity 0.3s ease;
      text-align: center;
      margin-top: 6px;
    }

    .smartbar.hovered .label,
    .smartbar.expanded .label {
      opacity: 1;
    }

    .user-name {
      text-align: center;
      font-weight: bold;
      font-size: 14px;
      padding: 16px 10px;
      border-bottom: 1px solid rgba(255,255,255,0.2);
    }

    .side-panel {
      position: fixed;
      top: 0;
      right: var(--smartbar-expanded-width);
      height: 100vh;
      width: var(--side-panel-width);
      background-color: #fff;
      color: #000;
      padding: 24px;
      box-shadow: -2px 0 6px rgba(0, 0, 0, 0.2);
      transform: translateX(100%);
      transition: transform 0.3s ease;
      z-index: 1000;
      overflow-y: auto;
      max-height: 100vh;
      display: none;
    }

    .side-panel.active {
      transform: translateX(0);
      display: block;
    }

    .side-panel .close-btn {
      position: absolute;
      top: 12px;
      left: 12px;
      font-size: 20px;
      background: none;
      border: none;
      cursor: pointer;
      font-weight: bold;
      z-index: 10;
      padding: 6px 10px;
      border-radius: 4px;
    }

    .card-list {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-top: 16px;
    }

    .card {
      background-color: #eee;
      padding: 16px;
      border-radius: 8px;
      text-align: center;
      font-weight: bold;
    }

    @media (max-width: 768px) {
       body {
        padding-bottom: 80px;
      }
      .smartbar {
        flex-direction: row;
        width: 100%;
        height: 80px;
        align-items: center;
        justify-content: space-around;
      }

      .smartbar.hovered,
      .smartbar.expanded {
        width: 100%;
      }

      .smartbar a {
        padding: 6px;
        max-width: 70px;
      }

      .smartbar .label {
        opacity: 1;
        font-size: 13px;
        text-align: center;
        margin-top: 4px;
        white-space: nowrap;
      }

      .user-name {
        display: none;
      }

      .side-panel {
        top: auto;
        bottom: 80px;
        left: 0;
        right: 0;
        width: 100%;
        height: auto;
        max-height: 60vh;
        transform: translateY(100%);
        box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.2);
      }

      .side-panel.active {
        transform: translateY(0);
        display: block;
      }
    }
  </style>
</head>
<body>

<!-- ===== Smartbar ===== -->
<div id="smartbar" class="smartbar">
  <?php if (isset($_SESSION['nama'])): ?>
    <div class="user-name">👤 <?= htmlspecialchars($_SESSION['nama']); ?></div>
  <?php endif; ?>

  <a href="#" onclick="togglePanel('produk', this)"><span class="material-symbols-outlined">apps</span><div class="label">Produk</div></a>
  <a href="#" onclick="togglePanel('layanan', this)"><span class="material-symbols-outlined">favorite</span><div class="label">Layanan</div></a>
  <a href="kalkulator2.php"><span class="material-symbols-outlined">calculate</span><div class="label">Kalkulator</div></a>
  <a href="#" onclick="togglePanel('webform', this)"><span class="material-symbols-outlined">edit</span><div class="label">Webform</div></a>
  

  <?php if (isset($_SESSION['nama'])): ?>
    <a href="logout.php"><span class="material-symbols-outlined">logout</span><div class="label">Logout</div></a>
  <?php else: ?>
    <a href="login.php"><span class="material-symbols-outlined">login</span><div class="label">Login</div></a>
  <?php endif; ?>
</div>

<div id="side-panel" class="side-panel">
  <button class="close-btn" onclick="closePanels()">✕</button>
  <div id="panel-content"></div>
</div>

<script>
  const smartbar = document.getElementById('smartbar');
  const panelContent = document.getElementById('panel-content');
  const sidePanel = document.getElementById('side-panel');

  const panelData = {
    produk: `<h2>Produk Individu</h2><div class='card-list'>
      <div class='card'>Simpanan Individu</div><div class='card'>Pinjaman Individu</div>
      <div class='card'>Wealth Management</div><div class='card'>Uang Elektronik</div>
      <div class='card'>Misbah</div><div class='card'>Kalkulator Nisbah</div>
      <div class='card'>Portofolio</div><div class='card'>Infoakun Transaksi</div>
    </div>`,
    layanan: "<h2>Layanan</h2><ul><li>Kartu Debit</li><li>Kartu Kredit</li><li>BIMA</li><li>Kantor Cabang</li></ul>",
    promo: "<h2>Promo</h2><p>Dapatkan berbagai penawaran menarik dan diskon di sini.</p>",
    webform: "<h2>Webform</h2><p>Isi formulir untuk pengajuan atau pertanyaan layanan.</p></p><br><p>coming soon..</p>",
  };

  function togglePanel(panelId, el) {
    document.querySelectorAll('.smartbar a').forEach(a => a.classList.remove('active'));
    el.classList.add('active');
    panelContent.innerHTML = panelData[panelId] || '';
    sidePanel.classList.add('active');
    smartbar.classList.add('expanded');
    smartbar.classList.remove('hovered');
  }

  function closePanels() {
    document.querySelectorAll('.smartbar a').forEach(a => a.classList.remove('active'));
    sidePanel.classList.remove('active');
    smartbar.classList.remove('expanded');
  }

  smartbar.addEventListener('mouseenter', () => {
    if (!sidePanel.classList.contains('active') && window.innerWidth > 768) {
      smartbar.classList.add('hovered');
    }
  });

  smartbar.addEventListener('mouseleave', () => {
    if (!sidePanel.classList.contains('active') && window.innerWidth > 768) {
      smartbar.classList.remove('hovered');
    }
  });

  document.addEventListener('click', function (e) {
    const isClickInsideSmartbar = smartbar.contains(e.target);
    const isClickInsidePanel = sidePanel.contains(e.target);
    if (!isClickInsideSmartbar && !isClickInsidePanel) {
      closePanels();
    }
  });
</script>

</body>
</html>
