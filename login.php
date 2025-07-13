<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $no_kartu = str_replace(' ', '', $_POST['no_kartu']);
    $no_rekening = $_POST['no_rekening'];
    $jenis_kartu = $_POST['jenis_kartu'];
    $pin = $_POST['pin'];

    try {
        if (empty($username) || empty($no_kartu) || empty($no_rekening) || empty($jenis_kartu) || empty($pin)) {
            throw new Exception("Semua field harus diisi!");
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE no_kartu = ?");
        $stmt->execute([$no_kartu]);
        $user = $stmt->fetch();

        if (!$user) {
            $saldo = 1000000;
            $cvv = generateRandomString(3);
            $masa_berlaku = date('m/y', strtotime('+3 years'));
            
            $stmt = $pdo->prepare("INSERT INTO users 
                (username, nama_lengkap, no_kartu, no_rekening, jenis_kartu, pin, saldo, cvv, masa_berlaku) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute([
                $username,
                $username, 
                $no_kartu,
                $no_rekening,
                $jenis_kartu,
                password_hash($pin, PASSWORD_BCRYPT),
                $saldo,
                $cvv,
                $masa_berlaku
            ]);
            
            $stmt = $pdo->prepare("SELECT * FROM users WHERE no_kartu = ?");
            $stmt->execute([$no_kartu]);
            $user = $stmt->fetch();
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama'] = $user['nama_lengkap'];
        $_SESSION['no_kartu'] = $user['no_kartu'];
        $_SESSION['no_rekening'] = $user['no_rekening'];
        $_SESSION['jenis_kartu'] = $user['jenis_kartu'];
        $_SESSION['saldo'] = $user['saldo'];
        $_SESSION['cvv'] = $user['cvv'];
        $_SESSION['masa_berlaku'] = $user['masa_berlaku'];
        $_SESSION['tanggal_bergabung'] = $user['tanggal_bergabung'];

        header("Location: home.php");
        exit();

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DigiBank</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 480px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }
        
        .login-header {
            background: linear-gradient(to right, #2563eb, #1e40af);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .login-body {
            padding: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #334155;
        }
        
        input, select {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        input:focus, select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            outline: none;
        }
        
        .card-options {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .card-option {
            flex: 1;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .card-option.selected {
            border-color: #2563eb;
            background-color: rgba(37, 99, 235, 0.05);
        }
        
        .card-option.gold.selected {
            border-color: #f59e0b;
            background-color: rgba(245, 158, 11, 0.05);
        }
        
        .card-option.platinum.selected {
            border-color: #64748b;
            background-color: rgba(100, 116, 139, 0.05);
        }
        
        .card-option.silver.selected {
            border-color: #cbd5e1;
            background-color: rgba(203, 213, 225, 0.2);
        }
        
        .card-icon {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        .card-name {
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .login-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(to right, #2563eb, #1e40af);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }
        
        .error-message {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 500;
            border-left: 4px solid #dc2626;
        }
        
        @media (max-width: 576px) {
            .login-container {
                border-radius: 12px;
            }
            
            .login-body {
                padding: 1.5rem;
            }
            
            .card-options {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>
                <span>🏦</span>
                DigiBank
            </h1>
        </div>
        
        <div class="login-body">
            <?php if (isset($error)): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan nama Anda" required>
                </div>
                
                <div class="form-group">
                    <label for="no_kartu">Nomor Kartu</label>
                    <input type="text" id="no_kartu" name="no_kartu" placeholder="6274 5110 0200 7788" maxlength="19" minlenght="19" required>
                </div>
                
                <div class="form-group">
                    <label for="no_rekening">Nomor Rekening</label>
                    <input type="text" id="no_rekening" name="no_rekening" placeholder="1234567890" maxlength="10" minlenght="10" required>
                </div>
                
                <div class="form-group">
                    <label>Jenis Kartu</label>
                    <div class="card-options">
                        <div class="card-option gold" onclick="selectCardType(this, 'Gold')">
                            <input type="radio" name="jenis_kartu" value="Gold" id="gold" style="display: none;" required>
                            <label for="gold">
                                <div class="card-icon">💳</div>
                                <div class="card-name">Gold</div>
                            </label>
                        </div>
                        <div class="card-option platinum" onclick="selectCardType(this, 'Platinum')">
                            <input type="radio" name="jenis_kartu" value="Platinum" id="platinum" style="display: none;">
                            <label for="platinum">
                                <div class="card-icon">💎</div>
                                <div class="card-name">Platinum</div>
                            </label>
                        </div>
                        <div class="card-option silver" onclick="selectCardType(this, 'Silver')">
                            <input type="radio" name="jenis_kartu" value="Silver" id="silver" style="display: none;">
                            <label for="silver">
                                <div class="card-icon">💳</div>
                                <div class="card-name">Silver</div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="pin">PIN (6 digit)</label>
                    <input type="password" id="pin" name="pin" placeholder="••••••" maxlength="6" required>
                </div>
                
                <button type="submit" class="login-button">MASUK KE AKUN</button>
            </form>
        </div>
    </div>

    <script>
        function selectCardType(element, type) {
            document.querySelectorAll('.card-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            element.classList.add('selected');
            
            document.querySelector(`input[value="${type}"]`).checked = true;
        }
        
        document.getElementById('no_kartu').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '');
            let formatted = '';
            
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formatted += ' ';
                }
                formatted += value[i];
            }
            
            e.target.value = formatted.substring(0, 19);
        });
    </script>
</body>
</html>
