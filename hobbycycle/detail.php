<?php
session_start();
include 'db.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT products.*, users.username FROM products JOIN users ON products.user_id = users.id WHERE products.id = '$id'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title><?php echo $data['name']; ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { display: block !important; }
        .detail-wrapper { max-width: 900px; margin: 50px auto; display: flex; gap: 40px; }
        .left { flex: 1; }
        .right { flex: 1.5; }
        .img-big { width: 100%; border-radius: 10px; border: 1px solid #333; }
        .desc { line-height: 1.6; color: #ccc; margin-top: 20px; white-space: pre-line; }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.php" style="color:white; font-weight:bold;">&larr; KEMBALI</a>
        <span style="color:white;">DETAIL PRODUK</span>
    </div>

    <div class="detail-wrapper">
        <div class="left">
            <img src="uploads/<?php echo $data['image']; ?>" class="img-big">
        </div>
        <div class="right">
            <h1 style="font-size: 32px; margin-top: 0;"><?php echo $data['name']; ?></h1>
            <div style="font-size: 28px; color: #ff3333; font-weight: bold; margin: 10px 0;">
                Rp <?php echo number_format($data['price']); ?>
            </div>
            <div style="background: #222; padding: 10px; border-radius: 5px; color: #888; display: inline-block;">
                Penjual: <b style="color: white;"><?php echo $data['username']; ?></b>
            </div>
            
            <div class="desc"><?php echo $data['description']; ?></div>
            
            <br><br>
            <?php if($data['status'] == 'available'): ?>
                <a href="buy.php?id=<?php echo $data['id']; ?>" class="btn-big" onclick="return confirm('Beli barang ini?')">🛒 BELI SEKARANG</a>
            <?php else: ?>
                <button disabled style="background: #555 !important; cursor: not-allowed;">SUDAH TERJUAL</button>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>