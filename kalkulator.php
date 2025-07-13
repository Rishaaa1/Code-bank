<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kalkulator Nisbah Syariah</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #e0f7fa, #ffffff);
      color: #004d40;
      margin: 0;
      padding-top: 60px;
    }
    header {
      text-align: center;
      padding: 30px 20px;
      background-color: #009688;
      color: white;
    }
    h1 {
      margin: 0;
      font-size: 2em;
    }
    .container {
      max-width: 600px;
      margin: 30px auto;
      background: #ffffff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.1);
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
      background-color:rgb(58, 253, 230);
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
    .result, .history {
      margin-top: 20px;
      padding: 20px;
      background: #e0f2f1;
      border-radius: 8px;
      font-size: 1rem;
    }
    .history {
      background: #f1f8e9;
    }
    footer {
      text-align: center;
      padding: 20px;
      font-size: 0.9rem;
      color: #607d8b;
    }
  </style>
</head>

<body>
  <?php include 'navbar.php' ; ?>
  <?php include 'smartbar.php' ; ?>
  <header>
    <h1>🧮 Kalkulator Nisbah Syariah</h1>
    <p>Hitung pembagian hasil usaha antara nasabah dan bank secara adil</p>
  </header>

  <div class="container">
    <label for="keuntungan">Total Keuntungan (Rp)</label>
    <input type="number" id="keuntungan" placeholder="Contoh: 1000000">

    <label for="nisbahNasabah">Nisbah Nasabah (%)</label>
    <input type="number" id="nisbahNasabah" placeholder="Contoh: 60">

    <label for="nisbahBank">Nisbah Bank (%)</label>
    <input type="number" id="nisbahBank" placeholder="Contoh: 40">

    <button onclick="hitungNisbah()">Hitung Nisbah</button>

    <div class="result" id="hasil"></div>
    <div class="history" id="riwayat"tyle="display:none;"></div>
  </div>

  <script>
    let hasilSebelumnya = null;

    function hitungNisbah() {
      const keuntungan = parseFloat(document.getElementById("keuntungan").value);
      const nisbahNasabah = parseFloat(document.getElementById("nisbahNasabah").value);
      const nisbahBank = parseFloat(document.getElementById("nisbahBank").value);

      if (isNaN(keuntungan) || isNaN(nisbahNasabah) || isNaN(nisbahBank)) {
        document.getElementById("hasil").innerHTML = "❗ Harap isi semua kolom dengan angka yang valid.";
        return;
      }

      if (nisbahNasabah + nisbahBank !== 100) {
        document.getElementById("hasil").innerHTML = "❗ Total nisbah harus 100%.";
        return;
      }

      const hasilNasabah = (keuntungan * nisbahNasabah) / 100;
      const hasilBank = (keuntungan * nisbahBank) / 100;

      if (hasilSebelumnya !== null) {
        document.getElementById("riwayat").style.display = 'block';
        document.getElementById("riwayat").innerHTML = `
          🕘 <strong>Riwayat Terakhir:</strong><br>
          Nasabah: <strong>Rp ${hasilSebelumnya.nasabah.toLocaleString()}</strong><br>
          Bank: <strong>Rp ${hasilSebelumnya.bank.toLocaleString()}</strong>
        `;
      }

      document.getElementById("hasil").innerHTML = `
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