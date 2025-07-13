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
      --smartbar-width: 70px;
      --smartbar-expanded-width: 200px;
      --side-panel-width: 380px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

   .smartbar {
      position: fixed;
      top: auto; 
      bottom: 0;
      right: 0;
      height: 100vh;
      width: var(--smartbar-width);
      background-color:rgb(240, 39, 25);
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: space-between; 
      transition: width 0.3s ease;
      overflow-y: auto; 
      overflow-x: hidden;
      z-index: 1002;
      padding: 0;
    }

        .smartbar.hovered,
        .smartbar.expanded {
          width: var(--smartbar-expanded-width);
        }

    .smartbar a {
      display: flex;
      flex-direction: row-reverse;
      align-items: center;
      justify-content: flex-end;
      padding: 40px 12px;
      color: white;
      text-decoration: none;
      flex-direction: column;
      transition: background 0.2s ease;
      cursor: pointer;
      min-height: 60px;  
      box-sizing: border-box;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .smartbar a.active,
    .smartbar a:hover {
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
      margin-left: 12px;
    }

    .smartbar .label {
      font-size: 16px;
      white-space: nowrap;
      opacity: 0;
      transition: opacity 0.3s ease;
      text-align: right;
      flex: 1;
    }

        .smartbar.hovered .label,
        .smartbar.expanded .label {
          opacity: 1;
        }
        
    .smartbar a {
      flex: 1;
    }
        .side-panel {
          position: fixed;
          top: 0;
          right: var(--smartbar-expanded-width);
          height: 100vh;
          width: var(--side-panel-width);
          background-color: #fff;
          color: #000;
          bottom: var(--smartbar-mobile-height); 
          padding: 24px;
          box-shadow: -2px 0 6px rgba(0, 0, 0, 0.2);
          transform: translateX(100%);
          transition: transform 0.3s ease;
          z-index: 1000;
          overflow-y: auto;
          display: none;
        }

        .side-panel.active {
          transform: translateX(0);
          display: block;
        }

        .side-panel .close-btn {
          color: black;
          position: fixed;
          top: 12px;
          left: 120px;
          font-size: 20px;
          background: none;
          border: none;
          cursor: pointer;
          font-weight: bold;
          z-index: 10;
          padding: 6px 10px;
          border-radius: 4px;
          box-shadow: 0 0 4px rgba(0,0,0,0.1);
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
            top: auto;
            bottom: 0;
            right: 0;
            align-items: center;
            justify-content: space-around;
          }

          .smartbar.hovered,
          .smartbar.expanded {
            width: 100%;
          }

          .smartbar a {
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 6px;
            max-width: 70px;
          }

          .smartbar span.material-symbols-outlined {
            font-size: 28px;
            margin-left: 0;
          }

          .smartbar .label {
            opacity: 1;
            font-size: 13px;
            text-align: center;
            margin-top: 4px;
            white-space: nowrap;
          }

          .side-panel {
            top: auto;
            bottom: 80px;
            right: 0;
            left: auto;
            width: 100%;
            height: auto;
            transform: translateY(100%);
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.2);
            display: none;
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
  <a href="login.php">
    <span class="material-symbols-outlined">login</span>
    <div class="label">Login</div>
  </a>
  <a href="#" onclick="togglePanel('produk', this)"><span class="material-symbols-outlined">apps</span><div class="label">Produk</div></a>
  <a href="#" onclick="togglePanel('layanan', this)"><span class="material-symbols-outlined">favorite</span><div class="label">Layanan</div></a>
<a href="kalkulator.php"><span class="material-symbols-outlined">calculate</span><div class="label">Kalkulator</div></a>
  <a href="#" onclick="togglePanel('webform', this)"><span class="material-symbols-outlined">edit</span><div class="label">Webform</div></a>
  <a href="#" onclick="togglePanel('chat', this)"><span class="material-symbols-outlined">chat</span><div class="label">pengaduan</div></a>
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
    produk: `
      <h2>Produk Individu</h2>
      <div class='card-list'>
        <div class='card'>Simpanan Individu</div>
        <div class='card'>Pinjaman Individu</div>
        <div class='card'>Wealth Management</div>
        <div class='card'>Uang Elektronik</div>
        <div class='card'>Misbah</div>
        <div class='card'>Kalkulator Nisbah</div>
        <div class='card'>Portofolio</div>
        <div class='card'>Infoakun Transaksi</div>
      </div>`,
    layanan: "<h2>Layanan</h2><ul><li>Kartu Debit</li><li>Kartu Kredit</li><li>BIMA</li><li>Internet Banking</li></ul>",
    promo: "<h2>Promo</h2><p>Dapatkan berbagai penawaran menarik dan diskon di sini.</p>",
    webform: "<h2>Webform</h2><p>Isi formulir untuk pengajuan atau pertanyaan layanan.</p><br><p>coming soon..</p>",
    chat: `<h2>Chat</h2><ul>${Array.from({ length: 1 }, (_, i) => `<li>Call Center & Pengaduan 14066 ${i + 1}</li><li>callcenter14066@bankjateng.co.id ${i + 1}</li></li><li href="">Kantor Pusat 024-3547541 ${i + 1}</li></li><li>sekretaris.perusahaan@bankjateng.co.id ${i + 1}</li>`).join('')}</ul>`
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
    if (!isClickInsideSmartbar && !isClickInsidePanel && sidePanel.classList.contains('active')) {
      return;
    }
    if (!isClickInsideSmartbar && !isClickInsidePanel) {
      closePanels();
    }
  });
</script>

</body>
</html>
