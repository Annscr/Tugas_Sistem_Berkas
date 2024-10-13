<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM resolusi WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    $query = "UPDATE resolusi SET judul = '$judul', deskripsi = '$deskripsi' WHERE id = $id";
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
    <title>Edit Resolusi</title>
    <link rel="stylesheet" href="style.css"> <!-- Menambahkan link CSS -->
</head>
<body>
    <h1>Edit Resolusi 2025</h1>
    <form action="" method="POST">
        <label for="judul">Judul:</label><br>
        <input type="text" name="judul" value="<?php echo $data['judul']; ?>" required><br><br>
        <label for="deskripsi">Deskripsi:</label><br>
        <textarea name="deskripsi" rows="5" cols="30"><?php echo $data['deskripsi']; ?></textarea><br><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
