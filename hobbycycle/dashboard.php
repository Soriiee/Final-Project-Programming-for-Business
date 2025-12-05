<?php
session_start();
if (!isset($_SESSION['is_login'])) { header("Location: index.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard - HobbyCycle</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Override Layout Khusus Dashboard */
        body { display: block !important; }
        .main-content { text-align: center; padding: 100px 20px; }
    </style>
</head>
<body>
    
    <div class="navbar">
        <a href="index.php" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="#d00000" stroke-width="2"/>
                <path d="M2 17L12 22L22 17" stroke="#d00000" stroke-width="2"/>
                <path d="M2 12L12 17L22 12" stroke="#d00000" stroke-width="2"/>
            </svg>
            <span style="font-size: 20px; font-weight: 800; color: white;">
                HOBBY<span style="color: #d00000;">CYCLE</span>
            </span>
        </a>
        <a href="logout.php" style="color: white; border: 1px solid #d00000; padding: 5px 15px; border-radius: 4px;">Logout</a>
    </div>

    <div class="main-content">
        <h1>Halo, <span style="color:#d00000"><?php echo $_SESSION['username']; ?></span>! 👋</h1>
        <p style="color: #aaa;">Selamat datang di markas penjualanmu.</p>
        
        <a href="inventory.php" class="btn-big">
            📦 KELOLA BARANG SAYA
        </a>
    </div>

</body>
</html>