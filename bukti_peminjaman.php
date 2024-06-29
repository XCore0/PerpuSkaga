<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user']) || !isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$peminjaman_id = $_GET['id'];

// Query untuk mendapatkan informasi peminjaman dari database
$query = "SELECT * FROM peminjaman WHERE PeminjamanID = '$peminjaman_id'";
$result = mysqli_query($koneksi, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "Peminjaman tidak ditemukan.";
    exit;
}

$peminjaman = mysqli_fetch_assoc($result);

// Ambil nama peminjam dari sesi login
$nama_peminjam = $_SESSION['nama'];

// Query untuk mendapatkan detail buku yang dipinjam dari database
$query_detail = "SELECT db.*, dp.* FROM detail_peminjaman dp INNER JOIN daftarbuku db ON dp.BukuID = db.BukuID WHERE dp.PeminjamanID = '$peminjaman_id'";
$result_detail = mysqli_query($koneksi, $query_detail);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Peminjaman</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Bukti Peminjaman</h1>

        <div class="mt-4">
            <h2>Informasi Peminjaman:</h2>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Nama Peminjam:</th>
                        <td><?php echo $nama_peminjam; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pinjam:</th>
                        <td><?php echo $peminjaman['TanggalPinjam']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali:</th>
                        <td><?php echo $peminjaman['TanggalKembali']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <h2>Detail Buku yang Dipinjam:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Buku</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result_detail)) : ?>
                        <tr>
                            <td><img src="images/<?php echo $row['GambarBuku']; ?>" alt="Foto Buku" style="max-width: 100px;"></td>
                            <td><?php echo $row['NamaBuku']; ?></td>
                            <td><?php echo $row['KategoriBuku']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Tambahkan tombol "Print" -->
        <div class="mt-4">
            <button onclick="window.print()" class="btn btn-primary mr-2">Print</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>

    </div>

    <!-- Tambahkan Bootstrap JS (Opsional, tergantung pada kebutuhan Anda) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>