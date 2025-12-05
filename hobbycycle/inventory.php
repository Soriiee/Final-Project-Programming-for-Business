<?php
session_start();
include 'db.php';
if (!isset($_SESSION['is_login'])) { header("Location: index.php"); exit(); }

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM products WHERE user_id = '$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Inventaris - HobbyCycle</title>
    <link rel="stylesheet" href="style.css">
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

    <div class="box-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="margin: 0;">Barang Jualanmu</h2>
            <a href="add_product.php" class="btn-add">+ Jual Barang</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Foto</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td style="text-align: center; color: #666;"><?php echo $no++; ?></td>
                    <td><img src="uploads/<?php echo $row['image']; ?>" style="width:50px; height:50px; object-fit:cover; border-radius:6px;"></td>
                    <td>
                        <div style="font-weight: bold; font-size: 15px;"><?php echo $row['name']; ?></div>
                    </td>
                    <td style="color: #d00000; font-weight: bold;">Rp <?php echo number_format($row['price']); ?></td>
                    <td>
                        <?php if($row['status'] == 'available'): ?>
                            <span class="badge bg-available">ACTIVE</span>
                        <?php else: ?>
                            <span class="badge bg-sold">SOLD</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($row['status'] == 'available'): ?>
                            <a href="edit_product.php?id=<?php echo $row['id']; ?>" style="color: #aaa; margin-right: 15px; font-size: 13px;">Edit</a>
                            <a href="delete_product.php?id=<?php echo $row['id']; ?>" style="color: #ff4d4d; font-size: 13px;" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        <?php else: ?>
                            <span style="color: #444; font-size: 12px;">Locked</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } } else { echo "<tr><td colspan='6' align='center' style='padding:40px; color:#666;'>Belum ada barang yang dijual.</td></tr>"; } ?>
            </tbody>
        </table>
    </div>

</body>
</html>