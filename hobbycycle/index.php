<?php
session_start();
include 'db.php';

$where = "WHERE status = 'available'"; 

if (isset($_GET['cari'])) {
    $keyword = $_GET['cari'];
    $where = "WHERE status = 'available' AND name LIKE '%$keyword%'"; 
}

$query = "SELECT products.*, users.username 
          FROM products 
          JOIN users ON products.user_id = users.id 
          $where 
          ORDER BY products.id DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>HobbyCycle - Marketplace Hitam</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="navbar">
        <a href="index.php" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="#d00000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 17L12 22L22 17" stroke="#d00000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 12L12 17L22 12" stroke="#d00000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span style="font-size: 24px; font-weight: 800; color: white; letter-spacing: 1px;">
                HOBBY<span style="color: #d00000;">CYCLE</span>
            </span>
        </a>

        <div class="menu">
            <?php if (isset($_SESSION['is_login'])): ?>
                <a href="orders.php">🛍️ Belanjaan</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php" style="color: #ff6b6b;">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn-login">Login / Daftar</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="hero">
        <h1>Temukan Koleksi Langka Di Sini</h1>
        <form action="index.php" method="GET" class="search-box">
            <input type="text" name="cari" class="search-input" placeholder="Cari Pokémon, Game, dll..." value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
            <button type="submit" class="search-btn">CARI</button>
        </form>
    </div>

    <div class="container-grid">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                
                <a href="detail.php?id=<?php echo $row['id']; ?>" class="card">
                    <img src="uploads/<?php echo $row['image']; ?>" class="card-img" alt="Foto Barang">
                    <div class="card-body">
                        <div class="card-price">Rp <?php echo number_format($row['price']); ?></div>
                        <h3 class="card-title"><?php echo $row['name']; ?></h3>
                        <div class="card-seller">
                            👤 <?php echo $row['username']; ?>
                        </div>
                    </div>
                </a>

            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align:center; grid-column: 1/-1; color: #888; font-size: 18px; margin-top: 50px;">
                Barang tidak ditemukan 😔
            </p>
        <?php endif; ?>
    </div>

</body>
</html>