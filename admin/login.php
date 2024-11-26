<?php
// Sertakan file koneksi database
include '../koneksi.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data admin berdasarkan email
    $sql = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Bandingkan password langsung
        if ($password === $row['password']) {
            $_SESSION['id_admin'] = $row['id_admin'];
            $_SESSION['email'] = $row['email'];

            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login Admin</h2>
    <form action="login.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <button type="submit">Login</button>
    </form>
</body>

</html>