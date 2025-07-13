<?php
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit();
}

$no_kartu = $_SESSION['no_kartu'];
$no_kartu_formatted = implode(' ', str_split($no_kartu, 4));

$card_styles = [
    'Gold' => [
        'primary' => '#f59e0b',
        'secondary' => '#d97706',
        'text' => '#1e293b',
        'icon' => '💳',
        'bg_light' => '#fef9c3'
    ],
    'Platinum' => [
        'primary' => '#64748b',
        'secondary' => '#475569',
        'text' => '#ffffff', 
        'icon' => '💎',
        'bg_light' => '#f1f5f9'
    ],
    'Silver' => [
        'primary' => '#e2e8f0',
        'secondary' => '#cbd5e1',
        'text' => '#1e293b',
        'icon' => '💳',
        'bg_light' => '#f8fafc'
    ]
];

$card_style = $card_styles[$_SESSION['jenis_kartu']] ?? $card_styles['Platinum'];

$saldo_formatted = 'Rp 1' . number_format($_SESSION['saldo'], 0, ',', '.');
$expiry_date = $_SESSION['masa_berlaku'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - DigiBank</title>
    <style>
        :root {
            --primary: <?php echo $card_style['primary']; ?>;
            --secondary: <?php echo $card_style['secondary']; ?>;
            --text: <?php echo $card_style['text']; ?>;
            --bg-light: <?php echo $card_style['bg_light']; ?>;
            --white: rgba(255, 255, 255, 0.9);
            --dark: #1e293b;
            --grey: #e2e8f0;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            color: var(--dark);
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        
        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }
        
        .bank-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .logout-btn {
            background: var(--dark);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            background: #0f172a;
        }
        
        /* Kartu*/
        .atm-card-container {
            display: flex;
            justify-content: center;
        }
        
        .atm-card {
            width: 100%;
            max-width: 550px;
            height: 320px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 25px;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: var(--text);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .atm-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--white) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
            z-index: -1;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .bank-name {
            font-size: 2rem;
            font-weight: 600;
            letter-spacing: 1px;
        }
        
        .card-type {
            background: rgba(0, 0, 0, 0.15);
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            color: white;
            font-size: 1rem;
            font-weight: 500;
        }
        
        .card-middle {
            margin: 1.5rem 0;
            position: relative;
        }
        
        .card-number {
            font-size: 2.2rem;
            letter-spacing: 4px;
            text-align: center;
            font-family: 'Courier New', monospace;
            font-weight: 600;
        }
        
        .card-cvv {
            position: absolute;
            right: 0;
            top: 50px;
            background: rgba(0, 0, 0, 0.2);
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        
        .card-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .card-label {
            font-size: 0.85rem;
            opacity: 0.8;
            letter-spacing: 1px;
        }
        
        .card-value {
            font-size: 1.2rem;
            font-weight: 500;
        }
        
        .card-chip {
            font-size: 3.5rem;
            opacity: 0.8;
        }
        
        /* Portfolio */
        .portfolio-section {
            margin-top: 1rem;
        }
        
        .section-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 1.8rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .info-card h3 {
            margin-bottom: 1.5rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.3rem;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid var(--grey);
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            color: #64748b;
            font-weight: 500;
        }
        
        .info-value {
            color: var(--dark);
            font-weight: 600;
            text-align: right;
        }
        
        .saldo {
            font-size: 1.8rem;
            text-align: center;
            margin-top: 1rem;
            color: var(--primary);
            font-weight: 700;
        }
        
        .transaction-list {
            list-style: none;
        }
        
        .transaction-item {
            padding: 1rem 0;
            border-bottom: 1px solid var(--grey);
            display: flex;
            justify-content: space-between;
        }
        
        .transaction-item:last-child {
            border-bottom: none;
        }
        
        .transaction-amount {
            font-weight: 600;
        }
        
        .transaction-amount.credit {
            color: #10b981;
        }
        
        .transaction-amount.debit {
            color: #ef4444;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .atm-card {
                height: 280px;
                padding: 1.8rem;
            }
            
            .bank-name {
                font-size: 1.5rem;
            }
            
            .card-number {
                font-size: 1.5rem;
                letter-spacing: 2px;
            }
            
            .card-cvv {
                top: 40px;
                font-size: 0.8rem;
            }
            
            .card-value {
                font-size: 1rem;
            }
            
            .card-chip {
                font-size: 2.8rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 480px) {
            .atm-card {
                height: 250px;
                padding: 1.5rem;
            }
            
            .card-number {
                font-size: 1.2rem;
            }
            
            .card-cvv {
                top: 35px;
            }
            
            .card-label {
                font-size: 0.7rem;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="bank-logo">
                <span>🏦</span>
                <span>Bank JATENG</span>
            </div>
            <a href="home.php" class="logout-btn">Keluar</a>
        </header>
        
        <!-- Kartu ATM -->
        <div class="atm-card-container">
            <div class="atm-card">
                <div class="card-header">
                    <div class="bank-name">Digibank</div>
                    <div class="card-type"><?php echo $_SESSION['jenis_kartu']; ?></div>
                </div>
                
                <div class="card-middle">
                    <div class="card-number">
                        <?php echo $no_kartu_formatted; ?>
                    </div>
                    <div class="card-cvv">CVV: <?php echo $_SESSION['cvv']; ?></div>
                </div>
                
                <div class="card-footer">
                    <div class="card-details">
                        <div class="card-label">NAMA PEMILIK</div>
                        <div class="card-value"><?php echo strtoupper($_SESSION['nama']); ?></div>
                        <div class="card-label">MASA BERLAKU</div>
                        <div class="card-value"><?php echo $expiry_date; ?></div>
                    </div>
                    <div class="card-chip">
                        <?php echo $card_style['icon']; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Portfolio -->
        <section class="portfolio-section">
            <h2 class="section-title">
                <span>💼</span>
                <span>Informasi Akun</span>
            </h2>
            
            <div class="grid-container">
                <div class="info-card">
                    <h3>
                        <span>👤</span>
                        <span>Informasi Akun</span>
                    </h3>
                    <div class="info-item">
                        <span class="info-label">Nomor Rekening</span>
                        <span class="info-value"><?php echo $_SESSION['no_rekening']; ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Jenis Kartu</span>
                        <span class="info-value"><?php echo $_SESSION['jenis_kartu']; ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Bergabung</span>
                        <span class="info-value"><?php echo $_SESSION['tanggal_bergabung']; ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status</span>
                        <span class="info-value">AKTIF</span>
                    </div>
                </div>
                
                <!-- Jumlah Saldo -->
                <div class="info-card">
                    <h3>
                        <span>💰</span>
                        <span>Saldo Rekening</span>
                    </h3>
                    <div class="saldo"><?php echo $saldo_formatted; ?></div>
                    <div class="info-item" style="margin-top: 2rem;">
                        <span class="info-label">Saldo Tersedia</span>
                        <span class="info-value"><?php echo $saldo_formatted; ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Saldo Tertahan</span>
                        <span class="info-value">Rp 0</span>
                    </div>
                </div>
                
                <!-- Transaksi Terakhir -->
                <div class="info-card">
                    <h3>
                        <span>📋</span>
                        <span>Transaksi Terakhir</span>
                    </h3>
                    <ul class="transaction-list">
                                                <li class="transaction-item">
                            <div>
                                <div>Pembelian Shopee</div>
                                <div style="font-size: 0.8rem; color: #64748b;"><?php echo date('d M Y', strtotime('-2 weeks')); ?></div>
                            </div>
                            <div class="transaction-amount debit">- Rp 732.000</div>
                        </li>
                    </ul>
                        <li class="transaction-item">
                            <div>
                                <div>Transfer antar bank </div>
                                <div style="font-size: 0.8rem; color: #64748b;"><?php echo date('d M Y'); ?></div>
                            </div>
                            <div class="transaction-amount debit">- Rp 500.000</div>
                        </li>
                        <li class="transaction-item">
                            <div>
                                <div>Gaji Bulanan</div>
                                <div style="font-size: 0.8rem; color: #64748b;"><?php echo date('d M Y', strtotime('-1 week')); ?></div>
                            </div>
                            <div class="transaction-amount credit">+ Rp 8.500.000</div>
                        </li>
                        <li class="transaction-item">
                            <div>
                                <div>Pembelian Tokopedia</div>
                                <div style="font-size: 0.8rem; color: #64748b;"><?php echo date('d M Y', strtotime('-2 weeks')); ?></div>
                            </div>
                            <div class="transaction-amount debit">- Rp 1.250.000</div>
                        </li>
                    </ul>
                                                            <li class="transaction-item">
                            <div>
                                <div>Gaji Bulanan</div>
                                <div style="font-size: 0.8rem; color: #64748b;"><?php echo date('d M Y', strtotime('-1 week')); ?></div>
                            </div>
                            <div class="transaction-amount credit">+ Rp 8.500.000</div>
                        </li>
                
                </div>

                <div class="info-card">
                    <h3>
                        <span>🛠️</span>
                        <span>Layanan Bank</span>
                    </h3>
                    <div class="info-item">
                        <span class="info-label">BIMA</span>
                        <span class="info-value">AKTIF</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label"> ibanking.bankjateng.co.i</span>
                        <span class="info-value">AKTIF</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">SMS Banking</span>
                        <span class="info-value">AKTIF</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">e-Statement</span>
                        <span class="info-value">AKTIF</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
