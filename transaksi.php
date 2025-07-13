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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informasi Akun Digital Bank Syariah</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel   ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    .card-product {
      transition: all 0.3s ease;
    }
    .card-product:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .active-status {
      background-color: #4CAF50;
    }
    .inactive-status {
      background-color: #F44336;
    }
    header {
      margin-top: 70px;
    }
  </style>
</head>
<body class="bg-gray-100 overflow-x-hidden">

<?php
$host = 'localhost';
$db = 'bankja214_digital_bank';
$user = 'bankja214_contohuser';
$pass = 'oi?GISOMEq=K';

try {
  $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("Koneksi gagal: " . $e->getMessage());
}

function getAccountInfo($username, $conn) {
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateName($username, $newName, $conn) {
  $stmt = $conn->prepare("UPDATE users SET nama_lengkap = ? WHERE username = ?");
  return $stmt->execute([$newName, $username]);
}


if (!isset($_SESSION['username'])) {
  $_SESSION['username'] = 'john_doe';
}

$updateMessage = '';
$accountInfo = getAccountInfo($_SESSION['username'], $conn);

if (!$accountInfo) {
  $accountInfo = [
    'nama_lengkap' => 'John Doe',
    'no_kartu' => '1234567890123456',
    'no_rekening' => '1234567890',
    'jenis_kartu' => 'Gold',
    'saldo' => 5000000.00,
    'tanggal_bergabung' => date('Y-m-d H:i:s')
  ];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_name'])) {
  $newName = htmlspecialchars(trim($_POST['new_name']));
  if (!empty($newName)) {
    if (updateName($_SESSION['username'], $newName, $conn)) {
      $updateMessage = '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">Nama berhasil diperbarui!</div>';
    } else {
      $updateMessage = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">Gagal memperbarui nama.</div>';
    }
  }
}
?>

<!-- header -->
<header>
  <?php include 'navbar2.php'; ?>
</header>

<!-- main Content -->
<main class="container mx-auto px-4 sm:px-6 py-8">
  <div class="flex flex-col lg:flex-row gap-8">

    <!-- informasi akun -->
    <div class="lg:w-1/3">
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-bold text-gray-800">Informasi Akun</h2>
          <span class="px-3 py-1 rounded-full text-xs font-medium text-<?php echo strtolower($accountInfo['jenis_kartu']) == 'platinum' ? 'purple' : (strtolower($accountInfo['jenis_kartu']) == 'gold' ? 'yellow' : 'gray'); ?>-800 bg-<?php echo strtolower($accountInfo['jenis_kartu']) == 'platinum' ? 'purple' : (strtolower($accountInfo['jenis_kartu']) == 'gold' ? 'yellow' : 'gray'); ?>-100">
            <?php echo $accountInfo['jenis_kartu']; ?>
          </span>
        </div>

        <div class="flex items-center mb-6">
          <div class="bg-teal-100 p-3 rounded-full mr-4">
            <i class="fas fa-user-circle text-teal-600 text-3xl"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold"><?php echo htmlspecialchars($accountInfo['nama_lengkap']); ?></h3>
            <p class="text-gray-600 text-sm">Anggota sejak <?php echo date('d M Y', strtotime($accountInfo['tanggal_bergabung'])); ?></p>
          </div>
        </div>

        <div class="space-y-4 text-sm break-words">
          <div>
            <p class="text-gray-500">Nomor Kartu</p>
            <p class="font-medium"><?php echo substr($accountInfo['no_kartu'], 0, 4) . ' XXXX XXXX ' . substr($accountInfo['no_kartu'], -4); ?></p>
          </div>
          <div>
            <p class="text-gray-500">Nomor Rekening</p>
            <p class="font-medium"><?php echo htmlspecialchars($accountInfo['no_rekening']); ?></p>
          </div>
          <div>
            <p class="text-gray-500">Saldo</p>
            <p class="font-bold text-lg text-teal-600">Rp <?php echo number_format($accountInfo['saldo'], 0, ',', '.'); ?></p>
          </div>
          <div>
            <p class="text-gray-500">Status</p>
            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Aktif</span>
          </div>
        </div>

        <hr class="my-6">

        <h3 class="font-medium mb-4">Perbarui Nama</h3>
        <?php echo $updateMessage; ?>
        <form method="POST">
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-medium mb-2" for="new_name">Nama Lengkap Baru</label>
            <input class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring focus:border-teal-500" id="new_name" type="text" name="new_name" value="<?php echo htmlspecialchars($accountInfo['nama_lengkap']); ?>" required>
          </div>
          <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 px-4 rounded">Perbarui</button>
        </form>
      </div>
    </div>

    <div class="lg:w-2/3">
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Produk Syariah Anda</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <!-- Jumlah Tabungan -->
          <div class="card-product border rounded-lg p-6">
            <div class="flex justify-between items-start mb-4">
              <div>
                <h3 class="font-bold">Tabungan Syariah</h3>
                <p class="text-sm text-gray-600">No. 888<?php echo substr($accountInfo['no_rekening'], -4); ?></p>
              </div>
              <span class="px-2 py-1 text-xs rounded-full active-status text-white">Aktif</span>
            </div>
            <p class="text-gray-700 mb-4">Tabungan sesuai prinsip syariah dengan sistem bagi hasil.</p>
            <div class="flex justify-between items-center text-sm">
              <p><span class="font-medium">Saldo:</span> Rp 5.750.000</p>
              <a href="#" class="text-teal-600 hover:text-teal-800">Detail</a>
            </div>
          </div>

          <!-- Pembiayaan -->
          <div class="card-product border rounded-lg p-6">
            <div class="flex justify-between items-start mb-4">
              <div>
                <h3 class="font-bold">Pembiayaan Syariah</h3>
                <p class="text-sm text-gray-600">No. INV/PN/<?php echo substr($accountInfo['no_kartu'], -6); ?></p>
              </div>
              <span class="px-2 py-1 text-xs rounded-full inactive-status text-white">Tidak Aktif</span>
            </div>
            <p class="text-gray-700 mb-4">Fasilitas pembiayaan dengan akad Murabahah.</p>
            <div class="flex justify-between items-center text-sm">
              <p><span class="font-medium">Limit:</span> Rp 50.000.000</p>
              <a href="#" class="text-teal-600 hover:text-teal-800">Ajukan</a>
            </div>
          </div>

          <!-- Deposito -->
          <div class="card-product border rounded-lg p-6 md:col-span-2">
            <div class="flex justify-between items-start mb-4">
              <div>
                <h3 class="font-bold">Deposito Syariah</h3>
                <p class="text-sm text-gray-600">No. DP/<?php echo date('Y'); ?>/<?php echo substr($accountInfo['no_rekening'], -4); ?></p>
              </div>
              <span class="px-2 py-1 text-xs rounded-full active-status text-white">Aktif</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
              <div><p class="text-gray-600">Jumlah</p><p class="font-medium">Rp 10.000.000</p></div>
              <div><p class="text-gray-600">Jangka Waktu</p><p class="font-medium">3 Bulan</p></div>
              <div><p class="text-gray-600">Estimasi Bagi Hasil</p><p class="font-medium">Rp 250.000</p></div>
            </div>
            <div class="mt-4">
              <a href="#" class="text-teal-600 hover:text-teal-800 text-sm">Perpanjang Deposito</a>
            </div>
          </div>
        </div>

        <!-- Transaksi Terakhir -->
        <div>
          <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-lg">Transaksi Terakhir</h3>
            <a href="#" class="text-teal-600 hover:text-teal-800 text-sm">Lihat Semua</a>
          </div>
          <div class="space-y-3">
            <div class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-lg">
              <div class="flex items-center">
                <div class="bg-teal-100 p-2 rounded-full mr-3"><i class="fas fa-arrow-down text-teal-600"></i></div>
                <div><p class="font-medium">Setoran Tunai</p><p class="text-sm text-gray-500">12 Jun 2023 • 08:45</p></div>
              </div>
              <p class="font-medium text-green-600">+ Rp 2.500.000</p>
            </div>
            <div class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-lg">
              <div class="flex items-center">
                <div class="bg-red-100 p-2 rounded-full mr-3"><i class="fas fa-arrow-up text-red-600"></i></div>
                <div><p class="font-medium">Transfer Antar Bank</p><p class="text-sm text-gray-500">10 Jun 2023 • 14:20</p></div>
              </div>
              <p class="font-medium text-red-600">- Rp 1.200.000</p>
            </div>
            <div class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-lg">
              <div class="flex items-center">
                <div class="bg-teal-100 p-2 rounded-full mr-3"><i class="fas fa-arrow-down text-teal-600"></i></div>
                <div><p class="font-medium">Bagi Hasil Deposito</p><p class="text-sm text-gray-500">5 Jun 2023 • 00:00</p></div>
              </div>
              <p class="font-medium text-green-600">+ Rp 250.000</p>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</main>

<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>
