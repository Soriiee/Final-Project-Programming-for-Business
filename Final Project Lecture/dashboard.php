<?php
session_start();
if ($_SESSION['is_login'] != true) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - HobbyCycle</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { display: block; }
        .content { padding: 50px; text-align: center; margin-top: 60px;}
    </style>
</head>
<body>
    <div class="dashboard-header">
        <h3>HobbyCycle</h3>
        <a href="logout.php" style="color: white; text-decoration: none; border: 1px solid white; padding: 5px 10px; border-radius: 5px;">Logout</a>
    </div>

    <div class="content">
        <h1>Hello, <?php echo $_SESSION['username']; ?>! 👋</h1>
        <p>Selamat datang di dashboard HobbyCycle.</p>
        <p><i>Fitur Jual Beli akan hadir di Minggu ke-2.</i></p>
    </div>
</body>
</html>