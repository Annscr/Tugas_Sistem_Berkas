<?php
include 'koneksi.php';

// Fungsi Pencarian Biner (case-insensitive)
function binarySearch($arr, $x) {
    $x = strtolower($x);  // Konversi input ke huruf kecil
    $l = 0;
    $r = count($arr) - 1;

    while ($l <= $r) {
        $mid = $l + (int)(($r - $l) / 2);

        if (strtolower($arr[$mid]['judul']) == $x)
            return $mid;

        if (strtolower($arr[$mid]['judul']) < $x)
            $l = $mid + 1;
        else
            $r = $mid - 1;
    }

    return -1;
}

// Fungsi Pencarian Interpolasi (case-insensitive)
function interpolationSearch($arr, $x) {
    $x = strtolower($x);  // Konversi input ke huruf kecil
    $low = 0;
    $high = count($arr) - 1;

    while ($low <= $high && strcmp($x, strtolower($arr[$low]['judul'])) >= 0 && strcmp($x, strtolower($arr[$high]['judul'])) <= 0) {
        $pos = $low + (int)(($high - $low) * ((strcmp($x, strtolower($arr[$low]['judul'])) - 0) / (strcmp(strtolower($arr[$high]['judul']), strtolower($arr[$low]['judul'])) - 0)));

        if (strtolower($arr[$pos]['judul']) == $x)
            return $pos;

        if (strtolower($arr[$pos]['judul']) < $x)
            $low = $pos + 1;
        else
            $high = $pos - 1;
    }

    return -1;
}

// Mengambil data dari database dan mengurutkannya
$query = "SELECT * FROM resolusi ORDER BY judul ASC";
$result = mysqli_query($conn, $query);
$resolusi = [];
while ($row = mysqli_fetch_assoc($result)) {
    $resolusi[] = $row;
}

// Pencarian
if (isset($_POST['search_biner'])) {
    $searchKey = $_POST['search_key'];
    $index = binarySearch($resolusi, $searchKey);

    if ($index != -1) {
        $searchResult = [$resolusi[$index]];
    } else {
        $searchResult = [];
    }
} elseif (isset($_POST['search_interpolasi'])) {
    $searchKey = $_POST['search_key'];
    $index = interpolationSearch($resolusi, $searchKey);

    if ($index != -1) {
        $searchResult = [$resolusi[$index]];
    } else {
        $searchResult = [];
    }
} else {
    $searchResult = $resolusi;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Resolusi 2025</title>
    <link rel="stylesheet" href="style.css"> <!-- Menambahkan link CSS -->
</head>
<body>
    <h1>Daftar Resolusi 2025</h1>

    <a href="tambah.php">Tambah Resolusi</a><br><br>

    <form method="POST">
        <label for="search_key">Cari Resolusi (berdasarkan judul):</label>
        <input type="text" name="search_key" required>
        <button type="submit" name="search_biner">Cari (Pencarian Biner)</button>
        <button type="submit" name="search_interpolasi">Cari (Pencarian Interpolasi)</button>
    </form>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        foreach ($searchResult as $row) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['judul'] . "</td>";
            echo "<td>" . $row['deskripsi'] . "</td>";
            echo "<td>" . $row['tanggal_dibuat'] . "</td>";
            echo "<td>
                <a href='edit.php?id=" . $row['id'] . "'>Edit</a> | 
                <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
