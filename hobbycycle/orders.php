<?php
session_start();
include 'db.php';

if (!isset($_SESSION['is_login'])) { header("Location: login.php"); exit(); }

$user_id = $_SESSION['user_id'];

$query = "SELECT transactions.*, products.name, products.price, products.image, products.description 
          FROM transactions 
          JOIN products ON transactions.product_id = products.id 
          WHERE transactions.user_id = '$user_id' 
          ORDER BY transactions.id DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Riwayat Belanja - HobbyCycle</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .item-box { 
            display: flex; 
            gap: 20px; 
            border-bottom: 1px solid #333;
            padding: 20px 0; 
            align-items: center; 
            transition: 0.3s;
        }
        .item-box:last-child { border-bottom: none; }
        .item-box:hover { background-color: #252525; padding-left: 10px; padding-right: 10px; border-radius: 8px; }

        .thumb { 
            width: 80px; 
            height: 80px; 
            object-fit: cover; 
            border-radius: 8px; 
            border: 1px solid #444; 
        }
        
        .badge-success {
            background: rgba(40, 167, 69, 0.2); 
            color: #28a745; 
            padding: 5px 12px; 
            border-radius: 20px; 
            font-size: 12px; 
            font-weight: bold; 
            border: 1px solid #28a745;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.php" style="display: flex; align-items: center; gap: 10px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d00000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            <span style="font-weight: 800; color: white;">HOBBY<span style="color: #d00000;">CYCLE</span></span>
        </a>
        <div class="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php" style="color:#ff6b6b">Logout</a>
        </div>
    </div>

    <div class="container" style="margin-top: 40px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #333; padding-bottom: 15px;">
            <h2 style="margin: 0; color: white;">📦 Barang Belanjaan Saya</h2>
            <a href="index.php" style="color: #aaa; font-size: 14px;">&larr; Lanjut Belanja</a>
        </div>

        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                
                <div class="item-box">
                    <img src="uploads/<?php echo $row['image']; ?>" class="thumb">
                    
                    <div style="flex: 1;"> 
                        <h3 style="margin: 0; color: white; font-size: 16px;"><?php echo $row['name']; ?></h3>
                        
                        <p style="color: #d00000; font-weight: bold; margin: 5px 0;">
                            Rp <?php echo number_format($row['price']); ?>
                        </p>
                        
                        <small style="color: #888;">
                            📅 Dibeli: <?php echo $row['date']; ?>
                        </small>
                    </div>
                    
                    <div style="text-align: right;">
                        <span class="badge-success">Berhasil Dibeli</span>
                    </div>
                </div>

            <?php endwhile; ?>
        <?php else: ?>
            <div style="text-align: center; padding: 50px;">
                <p style="color: #666; font-size: 16px;">Kamu belum pernah belanja apapun.</p>
                <a href="index.php" class="btn-big" style="margin-top: 10px;">Mulai Belanja</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>