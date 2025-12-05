<?php
session_start();
include 'db.php';

if (isset($_SESSION['is_login'])) { header("Location: index.php"); exit(); }

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['is_login'] = true;
            header("Location: index.php");
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login - HobbyCycle</title><link rel="stylesheet" href="style.css"></head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    
    <div class="container" style="width: 400px; text-align: center;">
        <h2 style="color: #d00000; margin-bottom: 10px;">HobbyCycle</h2>
        <h3 style="margin-top: 0;">Silakan Masuk</h3>
        
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" style="margin-top: 20px;">MASUK</button>
        </form>
        
        <br>
        <a href="register.php" style="color: #888; font-size: 14px;">Belum punya akun? <span style="color:#d00000">Daftar</span></a>
        <br><br>
        <a href="index.php" style="color: #666; font-size: 12px;">&larr; Kembali ke Home</a>
    </div>

</body>
</html>