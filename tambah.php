<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    $query = "INSERT INTO resolusi (judul, deskripsi) VALUES ('$judul', '$deskripsi')";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Resolusi</title>
    <link rel="stylesheet" href="style.css"> <!-- Menambahkan link CSS -->
</head>
<body>
    <h1>Tambah Resolusi 2025</h1>
    <form action="" method="POST">
        <label for="judul">Judul:</label><br>
        <input type="text" name="judul" required><br><br>
        <label for="deskripsi">Deskripsi:</label><br>
        <textarea name="deskripsi" rows="5" cols="30"></textarea><br><br>
        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>
